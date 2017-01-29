<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    protected $table = 'countries';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
