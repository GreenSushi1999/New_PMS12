<?php

namespace App;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class employees extends Model implements AuthenticatableContract
{
    use Authenticatable;


    protected $primaryKey = 'EmpNo';
    protected $table = 'HR.dbo.tblEmployees';
    public $timestamps = false;



    public function hr()
    {
        return $this->hasOne('App\hr', 'EmpNo', 'EmpNo');
    }

}


