<?php

namespace App\Http\Controllers\Forms;

use App\Forms;
use App\FormsValues;
use App\Http\Controllers\Controller;
use App\Institutions;
use App\Patients;
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
            $data = Forms::where(function ($query) use ($filters) {
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
                        $query->where('title', 'LIKE', '%' . $request->src . '%');
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
                'title' => 'required|string',
                'scheme' => 'required',
            ], [
                'title.required' => 'Please enter title',
                'scheme.required' => 'Please enter scheme'
            ]);
            $values = array_merge($validator->validate(), [
                'scheme' => json_encode($request->input('scheme'))
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }
            $forms = new Forms($values);
            $forms->save();

            return response()->json([
                'data' => wrapper_extra($forms),
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
            $data = Forms::find($id);
            $data->scheme = json_decode($data->scheme, 1);
            return json_response(wrapper_extra($data), 200);
        } catch (\Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'target' => 'required'
            ], [
                'target.required' => 'Please enter target'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }
            $data = Forms::find($id)->values($request->input('target'));
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
                'title' => 'required|string',
                'scheme' => 'required',
            ], [
                'title.required' => 'Please enter title',
                'scheme.required' => 'Please enter scheme'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }

            $values = array_merge($validator->validate(), [
                'scheme' => json_encode($request->input('scheme'))
            ]);

            Forms::where('id', $id)
                ->update($values);
            $forms = Forms::find($id);

            return response()->json([
                'data' => wrapper_extra($forms),
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
            if (!Forms::find($id)) {
                return json_response(trans('general.not.found'), 404);
            }
            $forms = Forms::find($id);
            $forms->delete();
            return response()->json([
                'data' => $forms,
            ], 202);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 402);
        }
    }
}
