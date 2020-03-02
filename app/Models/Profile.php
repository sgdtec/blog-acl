<?php

namespace App\Models;

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
}
