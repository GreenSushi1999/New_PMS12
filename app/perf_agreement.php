<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perf_agreement extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblperf_agreement';
    public $timestamps = true;

}
