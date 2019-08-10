<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeyController extends Controller
{
    //
    public function getPublicKeyVersion()
    {
        $key = DB::table('rsa_keys')->orderBy('version','desc')->select('version')->first();
        if ($key == NULL) {
            return response()->json([
                'reason'=>'key does not exit!'
            ],404);

        }
        return response()->json([
            'version'=>$key->version
        ]);
    }

    public function getPublicKey()
    {

    }
}
