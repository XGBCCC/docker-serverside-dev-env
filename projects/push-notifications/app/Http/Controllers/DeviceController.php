<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Resources\DeviceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Device as DeviceResource;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DeviceCollection
     */
    public function index()
    {
        //
        return new DeviceCollection(Device::orderBy('updated_at', 'desc')->get());
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'uuid' => 'required',
            'token' => 'required',
            'locale' => 'required|integer',
            'environment' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'reason' => 'Missing or invalid parameters.'
            ], 422);
        }

        $record = new DeviceResource(Device::create($request->all()));
//        broadcast(new DeviceRegistered($record));

        return response()->json($record, 201);
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
     * @param Device $device
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Device $device, Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'locale' => 'required|integer',
            'environment' => 'required|integer'
        ]);

        if ($validator->fails()) {
            dd($validator->failed());
            return response()->json([
                'reason' => 'Missing or invalid parameters.'
            ], 422);
        }

        $device->token = $request->input('token');
        $device->locale = $request->input('locale');
        $device->environment = $request->input('environment');
        $device->save();

        return response()->json(new DeviceResource($device));
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
