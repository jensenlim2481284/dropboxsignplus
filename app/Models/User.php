<?php

namespace App\Models;

use App\Models\Role;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];


    
    /*************************************************
      
                        BOOT 

     **************************************************/

    public static function boot()
    {
        parent::boot();
        self::creating(function ($user) {
            $user->uid = generateReferenceKey('user_');
        });
    }



}
