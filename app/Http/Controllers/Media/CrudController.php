<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'file' => 'required|image|dimensions:min_width=100,min_height=100'
            ], [
                'file.required' => 'Please enter file'
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->messages());
            }

            $file = $request->file('file');
            $relations = $request->input('relations');
            $name = Str::random(15);
            $sizes = array(
                'small' => Image::make($file)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream()->__toString(),
                'medium' => Image::make($file)->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream()->__toString(),
                'large' => Image::make($file)->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream()->__toString(),
                /*'original' => Image::make($file)->stream()->__toString()*/
            );

            $responseSize = array();

            foreach ($sizes as $key => $value) {
                $name_bulk = 'upload/' . $key . '_' . $name . '.png';
                Storage::disk('public')->put($name_bulk, $value);
                $responseSize[$key] = Storage::disk('public')->url($name_bulk);
            }


            $data = Media::create(
                [
                    'large' => $responseSize['large'],
                    'medium' => $responseSize['medium'],
                    'small' => $responseSize['small'],
                    'user_id' => Auth::guard()->id(),
                    'extra' => $relations
                ]
            );
            return response()->json([
                'data' => wrapper_extra($data),
            ], 201);
        } catch (\Exception $e) {
            return json_response($e->getMessage(), 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
