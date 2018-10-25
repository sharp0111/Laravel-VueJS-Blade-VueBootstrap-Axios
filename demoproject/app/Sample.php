<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $fillable = ['UUID', 'name', 'description', 'code', 'status'];
}
