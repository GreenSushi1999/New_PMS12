<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblratings';
    public $timestamps = true;

    public function evaluation()
    {
        return $this->hasOne('App\evaluation', 'cid', 'eval_cid');
    }
    public function performance()
    {
        return $this->hasOne('App\performance', 'cid', 'perf_cid');
    }

}
