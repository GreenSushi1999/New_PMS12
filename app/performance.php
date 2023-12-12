<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class performance extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblperformance';
    public $timestamps = true;

    public function achievement()
    {
        return $this->hasMany('App\achievement', 'perf_cid', 'cid');
    }
    public function recommendation()
    {
        return $this->hasMany('App\recommendation', 'perf_cid', 'cid');
    }
    public function perf_indicatorsAve()
    {
        return $this->hasOne('App\perf_indicatorsAve', 'perf_cid', 'cid');
    }
}
