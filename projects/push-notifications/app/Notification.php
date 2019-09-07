<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The columns that we can make a massive assignment.
     *
     * @var array
     * */
    protected $fillable = [
        'title', 'body', 'badge', 'locale', 'sound', 'environment'
    ];
}
