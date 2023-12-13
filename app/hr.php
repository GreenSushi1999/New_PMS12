<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hr extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'HR.dbo.vwActiveEmployeeDepartment';
    public $timestamps = false;



}