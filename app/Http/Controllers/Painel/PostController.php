<?php

namespace App\Http\Controllers\Painel;

use App\Models\Posts;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\StandartController;

class PostController extends StandartController {

    protected $model;
    protected $name   = 'Post';
    protected $view   = 'painel.posts';
    protected $route  = 'posts';
    protected $upload = ['name' => 'image' , 'path' => 'posts'];

    public function __construct(Posts $post) {

        $this->model = $post;
    }//__construct

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Cadastrar {$this->name}";

        $categories = Category::get()->pluck('name','id');

        return view("{$this->view}.create-edit", [
            'title' => $title,
            'categories' => $categories
        ]);
    }//create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //Valida os Dados
        $this->validate($request, $this->model->rules());

       //Recebendo os Dados da categoria
       $dataForm = $request->all();
       
       //Pegando se o checkbox está clicado
       $dataForm['featured'] = isset($dataForm['featured']) ? true : false;
       
       //Pegando o usuário logado no momento
       $dataForm['user_id'] = auth()->user()->id;

       //Verifica se existe uma imagem setada no Form
       if($this->upload && $request->hasFile($this->upload['name'])) {
        //Pega imagem do form
        $image = $request->file($this->upload['name']);

        //Define o nome da Imagem
        $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

        //Agora vai efetuar o upload
        $upload = $image->storeAs($this->upload['path'], $nameFile);

        if($upload) 
            $dataForm[$this->upload['name']] = $nameFile;
        else 
            return redirect()
                      ->route("{$this->route}.create")
                      ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                      ->withInput();
        }

        // Insert os dados da categoria
        $insertCategory = $this->model->create($dataForm);

        if($insertCategory) {
            return redirect()->route("{$this->route}.index")
                                ->with(['success' => 'Cadastro efetuado com sucesso!!']);
        } else {
            return redirect()
                        ->route("{$this->route}.create")
                        ->withErrors(['errors' => 'Falha ao cadastrar!'])
                        ->withInput();    
        }
    }//store

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $data = $this->model->find($id);

        $title = "Editar {$this->name}: {$data->title}";

        $categories = Category::get()->pluck('name','id');

        return view("{$this->view}.create-edit", [
            'data'       => $data,
            'title'      => $title,
            'categories' => $categories
        ]);
    }//edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        //valida os Dados
        $this->validate($request, $this->model->rules($id));

        //Pega todos os dados do formulário
        $dataForm = $request->all();

        ///Recebendo os Dados do Form
        $data = $this->model->find($id);

        //Pegando se o checkbox está clicado
        $dataForm['featured'] = isset( $dataForm['featured'] ) ? true : false;

        //Verifica se existe uma imagem setada no Form
        if($this->upload && $request->hasFile($this->upload['name'])) {
            //Pega imagem do form
            $image = $request->file($this->upload['name']);

            //verifica se o nome da imagem não, existe
            if( $data->image == '' ) {
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm[$this->upload['name']] = $nameImage;
            } else {
                $nameImage = $data->image;
                $dataForm[$this->upload['name']] = $data->image;
            }

            //Agora vai efetuar o upload
            $upload = $image->storeAs($this->upload['path'], $nameImage);

            if($upload) {
                $dataForm[$this->upload['name']] = $nameImage;
            } else {
                return redirect()->route("{$this->route}.edit", ['id' => $id])
                                 ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                                 ->withInput();
            }
        }//upload

        //Cria o objreto da categoria
        $data = $this->model->find($id);

        // Altera os dados da categoria
        $updateCategory = $data->update($dataForm);

        if($updateCategory) {
            return redirect()->route("{$this->route}.index")
                             ->with(['success' => 'Alteração efetuada com sucesso!!']);
        } else {
            return redirect()->route("{$this->route}.edit", ['id' => $id])
                             ->withErrors(['errors' => 'Falha ao editar, tente novamente!'])
                             ->withInput();    
        }
    }//update

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $data = $this->model->find($id);

        $title = "{$this->name}: {$data->title}";

        return view("{$this->view}.show", [
            'data'   => $data,
            'title' => $title
        ]);
    }//show

    public function search(Request $request) {
        $dataForm = $request->except('_token');    

        //Filtra as categorias
        $data = $this->model->where('title', 'LIKE', "%{$dataForm['key-search']}%")
                            ->orwhere('redline', 'LIKE', "%{$dataForm['key-search']}%")
                            ->orwhere('description', 'LIKE', "%{$dataForm['key-search']}%")
                            ->paginate($this->totalPage);

        $title = "Pesquisa de Postss";                    

        return view("{$this->view}.index",[
            'data'     => $data,
            'dataForm' => $dataForm,
            'title'    => $title
        ]);          
    }//search
}