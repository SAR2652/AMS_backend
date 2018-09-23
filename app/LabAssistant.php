<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabAssistant extends Model
{
    protected $table = 'LabAssistant';

    //Primary Key
    protected $primaryKey = 'uid';

    //Timestamp
    public $timestamps = false;
}
