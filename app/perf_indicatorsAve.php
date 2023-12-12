<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perf_indicatorsAve extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblperf_indicatorsAve';
    public $timestamps = true;


    public function indicators()
    {
        return $this->hasOne('App\indicators', 'cid', 'ind_cid');
    }
}
