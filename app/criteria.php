<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class criteria extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblcriteria';
    public $timestamps = true;
}
