<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class excel extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblExcel';
    public $timestamps = true;
}
