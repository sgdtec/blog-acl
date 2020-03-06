<?php

namespace App;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook',
        'twitter',
        'github',
        'site',
        'bibliograply',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     //Retorna todos os Perfis de um determinado user
     public function profiles() {
       
        return $this->belongsTomany(Profile::class);
    }

    public function hasPermission(Permission $permission){
       
        return $this->hasProfile($permission->profiles);
    }

    public function hasProfile($profile) {

        if(is_string($profile)) {
            return $this->profiles->contains('name', $profile);
        }

        return !! $profile->intersect($this->profiles)->count();
    }



}
