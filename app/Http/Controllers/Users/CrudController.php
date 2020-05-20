<?php

namespace App\Http\Controllers\Users;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Institutions;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use leifermendez\Reports\Reports;
use Maatwebsite\Excel\Facades\Excel;

class CrudController extends Controller
{
    private function export($name = 'filename', $format = 'pdf')
    {
        try {

            if ($format === 'pdf') {
                $format = [
                    'load' => \Maatwebsite\Excel\Excel::MPDF,
                    'extension' => 'pdf'
                ];
            }
            if ($format === 'xlsx') {
                $format = [
                    'load' => \Maatwebsite\Excel\Excel::XLSX,
                    'extension' => 'xlsx'
                ];
            }
            $name = $name . '.' . $format['extension'];
            Excel::store(new UserExport, $name, 'public');
            return Storage::disk('public')->url($name);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {

            $export = $request->input('export') ?
                $this->export(Str::random(5), $request->input('export')) : null;
            $limit = ($request->limit) ? $request->limit : env('PAGINATE');
            $filters = ($request->filters) ? explode("?", $request->filters) : [];
            $data = User::where(function ($query) use ($filters) {
                foreach ($filters as $value) {
                    $tmp = explode(",", $value);
                    if (isset($tmp[0]) && isset($tmp[1]) && isset($tmp[2])) {
                        $subTmp = explode("|", $tmp[2]);
                        if (count($subTmp)) {
                            foreach ($subTmp as $k) {
                                $query->orWhere($tmp[0], $tmp[1], $k);
                            }
                        } else {
                            $query->where($tmp[0], $tmp[1], $tmp[2]);
                        }

                    }
                }
            })
                ->where(function ($query) use ($request) {
                    if ($request->src) {
                        $query->where('name', 'LIKE', '%' . $request->src . '%')
                            ->orWhere('email', 'LIKE', '%' . $request->src . '%');
                    }

                })
                ->orderBy('id', 'DESC')
                ->paginate($limit);

            if ($export) {
                return json_response(array('file' => $export), 200);
            }

            return json_response($data, 200);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'level' => 'required|string|in:user,manager,admin',
                'email' => 'required|string|email|unique:users'
            ], [
                'name.required' => 'Please enter name',
                'level.required' => 'Please enter level',
                'email.required' => 'Please enter email'
            ]);


            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }

            $extra = parse_extra($request->input('extra'));

            $values = array_merge($validator->validate(),
                [
                    'user_id' => Auth::guard()->id(),
                ]);
            if ($extra && $extra !== 'null') {
                $values['extra'] = $extra;
            }
            if ($request->input('images')) {
                $values['images'] = parse_images($request->input('images'));
            }
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'level' => $request->level,
                'password' => bcrypt(Str::random(8)),
            ]);
            $user->save();
            $link = URL::temporarySignedRoute(
                'user.confirmed',
                now()->addDay(),
                ['id' => $user->id]
            );
            $user->link = $link;
            return response()->json([
                'data' => $user,
            ], 201);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id, Reports $pdf)
    {
        try {

            $data = User::where('id', $id)->gallery();
            if ($request->export) {
                $name = 'single_' . Str::random(25) . '.pdf';
                $link = $pdf->reportSingle($data, $name);
                return json_response([
                    'url' => $link
                ], 200);
            }
            return json_response(wrapper_extra($data), 200);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'level' => 'required|string|in:user,manager,admin',
            ], [
                'name.required' => 'Please enter name',
                'level.required' => 'Please enter level',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }
            if (Auth::guard()->user()->level !== 'admin' && ($request->input('level') === 'admin')) {
                throw new Exception(trans('not.permission'));
            }
            $extra = parse_extra($request->input('extra'));
            $values = array_merge($validator->validate(), ['user_id' => Auth::guard()->id()]);

            if ($extra && $extra !== 'null') {
                $values['extra'] = $extra;
            }
            if ($request->input('images')) {
                $values['images'] = parse_images($request->input('images'));
            }

            User::where('id', $id)
                ->update($values);
            $institution = User::find($id);

            return response()->json([
                'data' => wrapper_extra($institution),
            ], 201);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            if (!User::find($id)) {
                return json_response(trans('general.not.found'), 404);
            }
            $institution = User::find($id);
            $institution->delete();
            return response()->json([
                'data' => $institution,
            ], 202);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }
}
