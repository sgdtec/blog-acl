<?php

namespace App\Http\Controllers\Painel;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\StandartController;

class CategoryController extends StandartController
{
    protected $model;
    protected $name = 'Categoria';
    protected $view = 'painel.categories';

    public function __construct(Category $category) {

        $this->model = $category;
    }    
}