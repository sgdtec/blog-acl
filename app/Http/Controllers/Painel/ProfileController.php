<?php

namespace App\Http\Controllers\Painel;

use App\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\StandartController;

class ProfileController extends StandartController {
    
    protected $request;
    protected $model;
    protected $name      = 'Profile';
    protected $view      = 'painel.profiles';
    protected $route     = 'perfis';
    protected $totalPage = 10;

    public function __construct(Request $request, Profile $profile) {

        $this->model   = $profile;
        $this->request = $request;
    }

    public function users($id) {
       
        $profile = $this->model->find($id);

        $users = $profile->users()->distinct('user_id')->paginate($this->totalPage);

        $title = "Usuários com o perfil: {$profile->name}";

        return view('painel.profiles.users', [
            'profile' => $profile,
            'users'   => $users,
            'title'   => $title
        ]);
    }//users

    //Cadastra User ao Perfil
    public function usersAdd($id) {

        $profile = $this->model->find($id);

        $users = User::whereNotIn('id', function($query) use ($profile) {
            $query->select("profile_user.user_id");
            $query->from("profile_user");
            $query->whereRaw("profile_user.profile_id = {$profile->id}");
        })->get();

        $title = "Vincular usuário ao Perfil: {$profile->name}";

        return view('painel.profiles.users-add',[
            'profile' => $profile,
            'users'   => $users,
            'title'   => $title
        ]);
    }//usersAdd

    public function usersAddProfile($id) {

        $profile = $this->model->find($id);

        $profile->users()->attach($this->request->get('users'));

        return redirect()->route('profile.users', $id)
                         ->with(['success' => 'Vinculo realizado com sucesso!']);
    }//usersAddPRofile

    //Deletando user do Perfil
    public function deleteUser($id, $userId) {
        
        $profile = $this->model->find($id);

        $profile->users()->detach($userId);

        return redirect()->route('profile.users', $id)
                         ->with(['success' => "Perfil do usuário, foi removido com sucesso!"]);
    }//deleteUser

    public function searchUser($id){

        $dataForm = $this->request->except('_token');

        $profile = $this->model->find($id);

        //Filtra os Dados
        $users = $profile->users()
                         ->where('users.name', 'LIKE', "%{$dataForm['key-search']}%")
                         ->orWhere('users.email', $dataForm['key-search'])
                         ->paginate($this->totalPage);    

        return view('painel.profiles.users',[
            'users'     => $users,
            'dataForm'  => $dataForm,
            'profile'   => $profile
        ]);
    }//searchUser
}