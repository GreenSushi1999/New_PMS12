<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perf_indicatorsAve extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblperf_indicatorsAve';
    public $timestamps = true;
}
