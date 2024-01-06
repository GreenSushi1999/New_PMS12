<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class values extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblvalues';
    public $timestamps = true; 
    public function criteria()
    {
        return $this->hasMany('App\criteria', 'ind_cid', 'cid');
    }
}
