<?php

namespace App\Http\Controllers\Painel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Painel\UserFormRequest;

class UserController extends Controller
{
    private $user;
    protected $totalPage = 10;


    public function __construct(User $user){

        $this->user = $user;

        $this->middleware('can:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $title = 'Listagem dos usuários';
        
        $users = $this->user->paginate($this->totalPage);

        return view('painel.users.index', [
            'users' => $users,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $title = 'Cadastro de usuários';

        return view('painel.users.create-edit', [
            'title' => $title
        ]);
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
            return redirect()->route('usuarios.index')
                             ->with(['success' => 'Cadastro efetuado com sucesso!!']);
        } else {
            return redirect()->route('usuarios.create')
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
        $title = "Usuário : {$user->name}";

        return view('painel.users.show', [
            'user' => $user,
            'title' => $title
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

        $title = "Altera dados do Usuário: $user->name";

        return view('painel.users.create-edit', [
            'user'  => $user,
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

            //Verifica se a imagem existe
            if($user->image == '') {
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataUser['image'] = $nameImage;
            } else {
                $nameImage = $user->image;
                $dataUser['image'] = $user->image;
            }

            //Agora vai efetuar o upload
            $upload = $image->storeAs('users', $nameImage);

            if(!$upload)
                return redirect()->route('usuarios.edit', ['id' => $id])
                                 ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                                 ->withInput();
        }

        // Altera os dadosdo User
        $insertUser = $user->update($dataUser);

        if($insertUser) {
            return redirect()->route('usuarios.index')
            ->with(['success' => 'Alteração efetuada com sucesso!!']);
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

    public function search(Request $request) {
        $dataForm = $request->except('_token');    

        //Filtra os usuários
        $users = $this->user->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                            ->orWhere('email', 'LIKE', "%{$dataForm['key-search']}%")
                            ->paginate($this->totalPage);

        $title = "Listagem de Usuários";                    

        return view('painel.users.index',[
            'users'    => $users,
            'dataForm' => $dataForm,
            'title'    => $title
        ]);          
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile() {

        //Recupera o usuário        
        $user = auth()->user();

        $title = "Meu Perfil: $user->name";

        return view('painel.users.profile', [
            'user'  => $user,
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
    public function updateProfile(UserFormRequest $request,$id){
        
        $this->authorize('update_profile', $id);        

        //Recebendo os Dados do Form
        $dataUser = $request->all();

        //Cria o objreto do usuário
        $user = $this->user->find($id);

        //Criptografar Password
        $dataUser['password'] = bcrypt($dataUser['password']);

        //Removendo o E-mail para não atualizar
        unset($dataUser['email']);
        
        //Verifica se existe uma imagem setada no Form
        if($request->hasFile('image')) {
            //Pega imagem do form
            $image = $request->file('image');

            //Verifica se a imagem existe
            if($user->image == '') {
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataUser['image'] = $nameImage;
            } else {
                $nameImage = $user->image;
                $dataUser['image'] = $user->image;
            }

            //Agora vai efetuar o upload
            $upload = $image->storeAs('users', $nameImage);

            if(!$upload)
                return redirect()->route('profile')
                                 ->withErrors(['errors' => 'Erro ao fazer o upload!'])
                                 ->withInput();
        }

        // Altera os dadosdo User
        $insertUser = $user->update($dataUser);

        if($insertUser) {
            return redirect()->route('profile')
            ->with(['success' => 'Perfil atualizado com sucesso!!']);
        } else {
            return redirect()->route('profile')
                             ->withErrors(['errors' => 'Falha ao editar seu perfil, tente novamente!'])
                             ->withInput();    
        }
        
    }


}
