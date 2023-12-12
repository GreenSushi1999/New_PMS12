<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tbldoc_type';
    public $timestamps = true;

    public function indicators()
    {
        return $this->hasMany('App\indicators', 'doc_cid', 'cid');
    }
}
