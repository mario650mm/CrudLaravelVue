<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function filterAndPaginate($name,$email,$type)
    {
        return User::join('user_types','users.user_type_id','=','user_types.id')
            ->where('users.name','like',"%$name%")
            ->where('users.email','like',"%$email%")
            ->where('user_types.name','like',"%$type%")
            ->select('users.*','user_types.name as type')
            ->paginate();
    }

    public function user_type()
    {
        return $this->belongsTo('\App\UserType');
    }
}
