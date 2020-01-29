<?php

namespace App\Http\Controllers\Painel;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\StandartController;

class CategoryController extends StandartController
{
    protected $model;
    protected $name   = 'Categoria';
    protected $view   = 'painel.categories';
    protected $upload = ['name' => 'image', 'path' => 'categories'];
    protected $route  = 'categorias';

    public function __construct(Category $category) {

        $this->model = $category;
    }
    
    public function search(Request $request) {
        $dataForm = $request->except('_token');    

        //Filtra as categorias
        $data = $this->model->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                            ->paginate($this->totalPage);

        $title = "Pesquisa de categorias";                    

        return view("{$this->view}.index",[
            'cats'    => $data,
            'dataForm' => $dataForm,
            'title'    => $title
        ]);          
    }
}