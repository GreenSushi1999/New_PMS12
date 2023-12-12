<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblevaluation';
    public $timestamps = true;

}
