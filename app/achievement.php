<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class achievement extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblachievement';
    public $timestamps = true;
}
