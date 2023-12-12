<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agreement extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblagreement';
    public $timestamps = true;


    public function perf_agreement()
    {
        return $this->hasOne('App\perf_agreement', 'agr_cid', 'cid');
    }
}
