<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ratings extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblratings';
    public $timestamps = true;
}
