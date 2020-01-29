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
    protected $upload = false;    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Listagem {$this->name}s";

        $data  = $this->model->paginate($this->totalPage);
        
        return view("{$this->view}.index", [
            'title' => $title,
            'cats'  => $data
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
        $this->validate($request, $this->model->rules());

       //Recebendo os Dados da categoria
       $dataForm = $request->all();

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $data = $this->model->find($id);

        $title = "{$this->name}: {$data->name}";

        return view("{$this->view}.show", [
            'data'   => $data,
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
        $data = $this->model->find($id);

        $title = "Editar {$this->name}: {$data->name}";

        return view("{$this->view}.create-edit", [
            'cat'   => $data,
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
    public function update(Request $request, $id){

        //valida os Dados
        $this->validate($request, $this->model->rules($id));

        ///Recebendo os Dados do Form
        $dataForm = $request->all();

        //Cria o objreto da categoria
        $data = $this->model->find($id);

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
        }

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $data = $this->model->find($id);        

        if($data){
            $delete = $data->delete();
        }

        if($delete) {
            return redirect()->route("{$this->route}.index")
                             ->with(['success' => "A categoria <b>{$data->name}</b> foi excluida com sucesso!!"]);
        } else {
            return redirect()->route("{$this->route}.edit", ['id' => $id])
                             ->withErrors(['errors' => "Falha ao excluir a categoria <b>{$data->name}, tente novamente!"]);
        }
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