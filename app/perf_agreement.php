<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perf_agreement extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblperf_agreement';
    public $timestamps = true;

    public function agreement()
    {
        return $this->hasOne('App\agreement', 'cid', 'agr_cid');
    }
    public function performance()
    {
        return $this->hasOne('App\performance', 'cid', 'perf_cid');
    }
}
