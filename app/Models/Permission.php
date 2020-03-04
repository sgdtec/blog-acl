<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label'];

    public function rules() {

        return [
            'name'  => 'required|min:3|max:60',
            'label' => 'required|min:3|max:200'
        ];
    }

    //Retorna todos os perfis de uma determinada permissão
    public function profiles() {
       return $this->belongsToMany(Profile::class); 
    }
}
