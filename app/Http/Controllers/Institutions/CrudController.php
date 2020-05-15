<?php

namespace App\Http\Controllers\Institutions;

use App\Http\Controllers\Controller;
use App\Institutions;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
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
            })->paginate($limit);

            return json_response($data, 200);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 402);
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
                'address' => 'required|string'
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
            $institution = new Institutions($values);
            $institution->save();

            return response()->json([
                'data' => wrapper_extra($institution),
            ], 201);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {

            $data = Institutions::find($id);
            return json_response(wrapper_extra($data), 200);

        } catch (Exception $e) {
            return json_response($e->getMessage(), 402);
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
                'address' => 'required|string'
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

            Institutions::where('id', $id)
                ->update($values);
            $institution = Institutions::find($id);

            return response()->json([
                'data' => wrapper_extra($institution),
            ], 201);
        } catch (Exception $e) {
            return json_response($e->getMessage(), 402);
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
            return json_response($e->getMessage(), 402);
        }
    }
}
