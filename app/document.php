<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tbldoc_type';
    public $timestamps = true;
}
