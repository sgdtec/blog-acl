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

    public function __construct(User $user, Request $request){
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = $this->user->all();

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
            return 'Fail';    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
