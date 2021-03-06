<?php

namespace App\Http\Controllers\Staff;

use App\Exports\StaffExport;
use App\Http\Controllers\Controller;
use App\Staff;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            Excel::store(new StaffExport, $name, 'public');
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
    public function index(Request $request, Reports $pdf)
    {
        try {
            $auth = Auth::guard()->user();
            $labels = [
                'name' => 'Nombre',
                'address' => 'Dirección',
                'phone' => 'Telefono',
                'institutions_id' => 'Institucion'
            ];
            $export = $request->input('export') ?
                $pdf->listReport(Str::random(4) . '.pdf', 'Staff', $labels, $title = 'Personal',
                    ['institution']) : null;
            $limit = ($request->limit) ? $request->limit : env('PAGINATE');
            $filters = ($request->filters) ? explode("?", $request->filters) : [];
            $data = Staff::where(function ($query) use ($filters) {
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
                            ->orWhere('last_name', 'LIKE', '%' . $request->src . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->src . '%')
                            ->orWhere('extra', 'LIKE', '%' . $request->src . '%');
                    }
                    if ($auth->level !== 'admin') {
                        $query->where('zone', $auth->zone);
                    }
                })
                ->with(['user','institution'])
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
            $auth = Auth::guard()->user();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'institutions_id' => 'required',
                'email' => 'required|string|email',
                'age' => 'required',
                'gender' => '',
                'addressMore' => '',
                'description' => ''
            ], [
                'name.required' => 'Please enter name',
                'last_name.required' => 'Please enter last_name',
                'phone.required' => 'Please enter phone',
                'address.required' => 'Please enter address',
                'institutions_id.required' => 'Please enter institutions_id',
                'email.required' => 'Please enter email',
                'age.required' => 'Please enter age'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }

            $extra = parse_extra($request->input('extra'));

            $values = array_merge($validator->validate(),
                [
                    'user_id' => Auth::guard()->id(),
                    'zone' => $auth->zone
                ]);
            if ($extra && $extra !== 'null') {
                $values['extra'] = $extra;
            }
            if ($request->input('images')) {
                $values['images'] = parse_images($request->input('images'));
            }

            $institution = new Staff($values);
            $institution->save();

            return response()->json([
                'data' => wrapper_extra($institution),
            ], 201);
        } catch (Exception $e) {

            return json_response($e->getTrace(), 403);
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
            $data = Staff::where('id', $id)->gallery();
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
                'last_name' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'institutions_id' => 'required',
                'email' => 'required|string|email',
                'age' => 'required',
                'description' => '',
                'images' => '',
            ], [
                'name.required' => 'Please enter name',
                'phone.required' => 'Please enter phone',
                'institutions_id.required' => 'Please enter institutions_id',
                'email.required' => 'Please enter email',
                'age.required' => 'Please enter age'
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
            Staff::where('id', $id)
                ->update($values);
            $institution = Staff::find($id);

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
            if (!Staff::find($id)) {
                return json_response(trans('general.not.found'), 404);
            }
            $institution = Staff::find($id);
            $institution->delete();
            return response()->json([
                'data' => $institution,
            ], 202);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }
}
