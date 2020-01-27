<?php

namespace App\Http\Controllers\Painel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\UserFormRequest;

class UserController extends Controller
{
    private $user;
    private $request;
    protected $totalPage = 10;


    public function __construct(User $user, Request $request){
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate($this->totalPage);

        return view('painel.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.users.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        //Recebendo os Dados do Form
        $dataUser = $request->all();

        //Criptografar Password
        $dataUser['password'] = bcrypt($dataUser['password']);

        //Verifica se existe uma imagem setada no Form
        if($request->hasFile('image')) {
            //Pega imagem do form
            $image = $request->file('image');

            //Define o nome da Imagem
            $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            //Agora vai efetuar o upload
            $upload = $image->storeAs('users', $nameImage);

            if($upload) 
                $dataUser['image'] = $nameImage;
            else 
                return redirect('/painel/usuarios/create')
                       ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                       ->withInput();
        }

        // Insert data of User
        $insertUser = $this->user->create($dataUser);

        if($insertUser) {
            return redirect('/painel/usuarios');
        } else {
            return redirect('/painel/usuarios/create')
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
        
        //Recupera usuário
        $user = $this->user->find($id);

        return view('painel.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //Recupera o usuário pelo id
        $user = $this->user->find($id);

        return view('painel.users.create-edit', [
            'user' => $user
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request,$id){
        //Recebendo os Dados do Form
        $dataUser = $request->all();

        //Cria o objreto do usuário
        $user = $this->user->find($id);

        //Criptografar Password
        if (isset($dataUser['password']) && $dataUser['password'] != '') {
            $dataUser['password'] = bcrypt($dataUser['password']);
        } else {
            unset($dataUser['password']);    
        }

        //Verifica se existe uma imagem setada no Form
        if($request->hasFile('image')) {
            //Pega imagem do form
            $image = $request->file('image');

            //Agora vai efetuar o upload
            $upload = $image->storeAs('users', $usr->image);

            if(!$upload)
                return redirect()->route('usuarios.edit', ['id' => $id])
                                 ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                                 ->withInput();
        }

        // Altera os dadosdo User
        $insertUser = $user->update($dataUser);

        if($insertUser) {
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->route('usuarios.edit', ['id' => $id])
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
    public function destroy($id) {

        $user = $this->user->find($id);

        $delete = $user->delete();

        if($delete) {
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->route('usarios.show', ['id' => $id])
                             ->withErrors(['errors' => "Falha ao deletar o usuário $user->name, tente novamente!"]);
        }
    }

    public function search() {
        $dataForm = $this->request->except('_token');

        //Filtra os usuários
        $users = $this->user->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                            ->orWhere('email', $dataForm['key-search'])
                            ->paginate($this->totalPage);

        return view('painel.users.index',[
            'users' => $users,
            'dataForm' => $dataForm
        ]);          
    }
}
