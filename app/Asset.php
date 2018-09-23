<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    //Primary Key
    protected $primaryKey = 'asset_id';

    //Timestamp
    public $timestamps = false;
}
