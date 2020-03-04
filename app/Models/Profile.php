<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'label'];

    public function rules() {

        return [
            'name'  => 'required|min:3|max:60',
            'label' => 'required|min:3|max:200'
        ];
    }

    //Lista todos os usuários ao perfil
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
