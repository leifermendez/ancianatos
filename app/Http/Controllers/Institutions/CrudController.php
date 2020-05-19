<?php

namespace App\Http\Controllers\Institutions;

use App\Exports\InstitutionsExport;
use App\Exports\SingleInstitutionsExport;
use App\Http\Controllers\Controller;
use App\Institutions;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use leifermendez\Reports\Reports;

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
            Excel::store(new InstitutionsExport, $name, 'public');
            return Storage::disk('public')->url($name);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Auth $auth
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $auth = Auth::guard()->user();
            $export = $request->input('export') ?
                $this->export(Str::random(5), $request->input('export')) : null;
            $limit = ($request->limit) ? $request->limit : env('PAGINATE');
            $filters = ($request->filters) ? explode("?", $request->filters) : [];
            $data = Institutions::where(function ($query) use ($filters) {
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
                ->where(function ($query) use ($request, $auth) {
                    if ($request->src) {
                        $query->where('name', 'LIKE', '%' . $request->src . '%')
                            ->orWhere('address', 'LIKE', '%' . $request->src . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->src . '%')
                            ->orWhere('extra', 'LIKE', '%' . $request->src . '%');
                    }

                    if ($auth->level !== 'admin') {
                        $query->where('user_id',$auth->id);
                    }

                })
                ->with(['user'])
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
                'address' => 'required|string',
                'description' => '',
                'extra' => '',
            ], [
                'name.required' => 'Please enter name',
                'address.required' => 'Please enter address'
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
            $institution = new Institutions($values);
            $institution->save();

            return response()->json([
                'data' => wrapper_extra($institution),
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
            $data = Institutions::where('id', $id)->with(['user'])->gallery();
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
                'address' => 'required|string',
                'description' => '',
                'extra' => '',
            ], [
                'name.required' => 'Please enter name',
                'address.required' => 'Please enter address'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }
            $extra = parse_extra($request->input('extra'));
            $values = array_merge($validator->validate(), ['user_id' => Auth::guard()->id()]);

            if ($extra && $extra !== 'null') {
                $values['extra'] = $extra;
            }
            if ($request->input('images')) {
                $values['images'] = parse_images($request->input('images'));
            }
            Institutions::where('id', $id)
                ->update($values);
            $institution = Institutions::find($id);

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
            if (!Institutions::find($id)) {
                return json_response(trans('general.not.found'), 404);
            }
            $institution = Institutions::find($id);
            $institution->delete();
            return response()->json([
                'data' => $institution,
            ], 202);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }
}
