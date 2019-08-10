<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RsaKeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rsa_keys')->truncate();
        factory(\App\RsaKey::class, 2)->create();
    }
}
