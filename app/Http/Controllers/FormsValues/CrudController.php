<?php

namespace App\Http\Controllers\FormsValues;

use App\Forms;
use App\FormsValues;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {

            $export = $request->input('export') ?
                $this->export(Str::random(5), $request->input('export')) : null;
            $limit = ($request->limit) ? $request->limit : env('PAGINATE');
            $filters = ($request->filters) ? explode("?", $request->filters) : [];
            $data = FormsValues::where(function ($query) use ($filters) {
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
                        $query->where('values', 'LIKE', '%' . $request->src . '%');
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
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'forms_id' => 'required',
                'values' => 'required',
                'target_id' => 'required',
            ], [
                'forms_id.required' => 'Please enter forms_id',
                'values.required' => 'Please enter values',
                'target_id.required' => 'Please enter target_id'
            ]);
            $values = array_merge($validator->validate(), [
                'values' => json_encode($request->input('values')),
                'user_id' => Auth::guard()->id(),
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }
            $forms = new FormsValues($values);
            $forms->save();

            return response()->json([
                'data' => wrapper_values($forms),
            ], 201);
        } catch (\Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        try {
            $data = FormsValues::find($id);
            $json_raw = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data->values);
            json_decode($json_raw);
            if (json_last_error()) {
                dd(json_last_error());
            }
            $data->values = json_decode($data->values, 1);
            return json_response(wrapper_values($data), 200);
        } catch (\Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
                'forms_id' => 'required',
                'values' => 'required',
                'target_id' => 'required',
            ], [
                'forms_id.required' => 'Please enter forms_id',
                'values.required' => 'Please enter values',
                'target_id.required' => 'Please enter target_id'
            ]);
            $values = array_merge($validator->validate(), [
                'values' => json_encode($request->input('values')),
                'user_id' => Auth::guard()->id(),
            ]);

            FormsValues::where('id', $id)
                ->update($values);
            $forms = FormsValues::find($id);

            return response()->json([
                'data' => wrapper_values($forms),
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
            if (!FormsValues::find($id)) {
                return json_response(trans('general.not.found'), 404);
            }
            $forms = FormsValues::find($id);
            $forms->delete();
            return response()->json([
                'data' => $forms,
            ], 202);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 402);
        }
    }
}
