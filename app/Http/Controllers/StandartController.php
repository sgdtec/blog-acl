<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StandartController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $totalPage = 10;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Listagem {$this->name}s";

        $cats = $this->model->paginate($this->totalPage);
        
        return view("{$this->view}.index", [
            'title' => $title,
            'cats'  => $cats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar {$this->name}";

        return view("{$this->view}.create-edit", [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valida os Dados
        $this->valadate($request, $this->model->rules());

       //Recebendo os Dados da categoria
       $dataForm = $request->all();

       //Verifica se existe uma imagem setada no Form
       if($request->hasFile('image')) {
           //Pega imagem do form
           $image = $request->file('image');

           //Define o nome da Imagem
           $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

           //Agora vai efetuar o upload
           $upload = $image->storeAs('categories', $nameImage);

           if($upload) 
               $dataForm['image'] = $nameImage;
           else 
               return redirect()
                         ->route('categorias.create')
                         ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                         ->withInput();
       }

       // Insert os dados da categoria
       $insertCategory = $this->category->create($dataForm);

       if($insertCategory) {
           return redirect()->route('categorias.index')
                            ->with(['success' => 'Cadastro efetuado com sucesso!!']);
       } else {
           return redirect()
                      ->route('categorias.create')
                      ->withErrors(['errors' => 'Falha ao cadastrar!'])
                      ->withInput();    
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $cat = $this->category->find($id);

        $title = "categoria: {$cat->name}";

        return view('painel.categories.show', [
            'cat'   => $cat,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $cat = $this->category->find($id);

        $title = "Editar a Categoria: {$cat->name}";

        return view('painel.categories.create-edit', [
            'cat'   => $cat,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id){
        ///Recebendo os Dados do Form
        $dataForm = $request->all();

        //Cria o objreto da categoria
        $cat = $this->category->find($id);

        //Verifica se existe uma imagem setada no Form
        if($request->hasFile('image')) {
            //Pega imagem do form
            $image = $request->file('image');

            //verifica se o nome da imagem não, existe
            if( $cat->image == '' ) {
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm['image'] = $nameImage;
            } else {
                $nameImage = $cat->image;
            }

            //Agora vai efetuar o upload
            $upload = $image->storeAs('categories', $nameImage);

            if(!$upload)
                return redirect()->route('categorias.edit', ['id' => $id])
                                 ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                                 ->withInput();
        }

        // Altera os dados da categoria
        $updateCategory = $cat->update($dataForm);

        if($updateCategory) {
            return redirect()->route('categorias.index')
                             ->with(['success' => 'Alteração efetuada com sucesso!!']);
        } else {
            return redirect()->route('categorias.edit', ['id' => $id])
                             ->withErrors(['errors' => 'Falha ao editar, tente novamente!'])
                             ->withInput();    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $cat = $this->category->find($id);

        $delete = $cat->delete();

        if($delete) {
            return redirect()->route('categorias.index')
                             ->with(['success' => "A categoria <b>{$cat->name}</b> foi excluida com sucesso!!"]);
        } else {
            return redirect()->route('categorias.edit', ['id' => $id])
                             ->withErrors(['errors' => "Falha ao excluir a categoria <b>{$cat->name}, tente novamente!"])
                             ->withInput();    
        }
    }

    public function search(Request $request) {
        $dataForm = $request->except('_token');    

        //Filtra as categorias
        $cats = $this->category->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                            ->orWhere('url', 'LIKE', "%{$dataForm['key-search']}%")
                            ->paginate($this->totalPage);

        $title = "Pesquisa de categorias";                    

        return view('painel.categories.index',[
            'cats'    => $cats,
            'dataForm' => $dataForm,
            'title'    => $title
        ]);          
    }
}