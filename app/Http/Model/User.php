<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'u_common';
    public $timestamps = false;
    protected $primaryKey = 'uid';

    
}
