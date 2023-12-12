<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicators extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblindicators';
    public $timestamps = true;
}
