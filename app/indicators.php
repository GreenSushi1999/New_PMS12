<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicators extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblindicators';
    public $timestamps = true;
    protected $fillable = ['criteria', 'remarks', 'percentage', 'ord'];


    public function evaluation()
    {
        return $this->hasMany('App\evaluation', 'ind_cid', 'cid');
    }
    public function document()
    {
        return $this->hasMany('App\document', 'cid', 'doc_cid');
    }
    public function perf_indicatorsAve()
    {
        return $this->hasOne('App\perf_indicatorsAve', 'ind_cid', 'cid');

    }
}
