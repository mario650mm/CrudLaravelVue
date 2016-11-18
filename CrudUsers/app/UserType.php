<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    protected $table = 'user_types';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];
}
