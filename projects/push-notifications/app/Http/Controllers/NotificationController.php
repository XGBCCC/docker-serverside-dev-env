<?php

namespace App\Http\Controllers;

use App\Notification;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationCollection;
use App\Events\NewNotification;
use Illuminate\Support\Facades\Log;
use App\Device;
use App\Traits\AES;
use App\Traits\MIX;
use App\Traits\RSA;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\NotificationCollection
     */
    public function index()
    {
        /**
         * Original:
         * { data: [{}, {}, {}]}
         *
         * Encrypted:
         * {
         *   key: base64(key):base64(iv)
         *   encrypted: xxxxxxxxxxxxxxxxx
         * }
         */
        return new NotificationCollection(
            Notification::orderBy('updated_at', 'desc')->get());
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validated = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'badge' => 'required',
            'locale' => 'required',
            'sound' => 'required',
            'environment' => 'required'
        ]);

        $notification = Notification::create($validated);
        event(new NewNotification($notification));

        return response()->json($notification);
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
