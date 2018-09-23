<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';

    //Primary Key
    protected $primaryKey = 'uid';

    //Timestamp
    public $timestamps = false;
}
