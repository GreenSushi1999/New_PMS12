<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agreement extends Model
{
    protected $primaryKey = 'cid';
    protected $table = 'tblagreement';
    public $timestamps = true;
}
