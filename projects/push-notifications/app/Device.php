<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * The columns that we can make a massive assignment.
     *
     * @var array
     * */
    protected $fillable = [
        'uuid', 'token', 'locale', 'environment'
    ];
}
