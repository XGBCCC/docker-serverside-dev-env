<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsaKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rsa_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('public');
            $table->text('private');
            $table->text('passcode',32);
            $table->smallInteger('version');
            $table->softDeletes(); //deleted_at
            $table->timestamps(); //created_at updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rsa_keys');
    }
}
