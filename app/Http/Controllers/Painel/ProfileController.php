<?php

namespace App\Http\Controllers\Painel;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\StandartController;

class ProfileController extends StandartController {

    protected $model;
    protected $name   = 'Profile';
    protected $view   = 'painel.profiles';
    protected $route  = 'perfis';

    public function __construct(Profile $profile) {

        $this->model = $profile;
    }
}
