<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class performance extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblperformance';
    public $timestamps = true;
}
