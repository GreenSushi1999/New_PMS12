<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class version extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblversion';
    public $timestamps = true;
}
