<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recommendation extends Model
{

    protected $primaryKey = 'cid';
    protected $table = 'tblrecommendation';
    public $timestamps = true;
}
