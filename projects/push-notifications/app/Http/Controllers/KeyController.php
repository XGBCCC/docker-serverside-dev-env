<?php

namespace App\Http\Controllers;

use App\Http\Resources\RsaKey as RsaKeyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeyController extends Controller
{
    //
    public function getPublicKeyVersion()
    {
        $key = DB::table('rsa_keys')->orderBy('version', 'desc')->select('version')->first();
        if ($key == NULL) {
            return response()->json([
                'reason' => 'key does not exit!'
            ], 404);

        }
        return response()->json([
            'version' => $key->version
        ]);
    }

    public function getPublicKey()
    {
        $key = DB::table('rsa_keys')
            ->orderBy('version', 'desc')
            ->first();

        if ($key == NULL) {
            return response()->json([
                'reason' => 'Key does not exist!'
            ], 404);
        }
        return response()->json(new RsaKeyResource($key));
    }
}
