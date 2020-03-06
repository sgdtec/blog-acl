<?php

namespace App\Http\Controllers\Painel;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\StandartController;

class PermissionController extends StandartController
{
    
    protected $request;
    protected $model;
    protected $name      = 'Permission';
    protected $view      = 'painel.permissions';
    protected $route     = 'permissoes';
    protected $totalPage = 10;

    public function __construct(Request $request, Permission $permission) {

        $this->model   = $permission;
        $this->request = $request;

        $this->middleware('can:permissions');
    }

    public function profiles($id) {

        $permission = $this->model->find($id);

        $profiles = $permission->profiles()->paginate($this->totalPage);

        $title = "Perfis com a permissão: {$permission->name}";

        return view('painel.permissions.profiles', [
            'permission' => $permission,
            'profiles'   => $profiles,
            'title'      => $title
        ]);
    }//profiles

    public function profilesAdd($id) {

        $permission = $this->model->find($id);

        $profiles = Profile::whereNotIn('id', function($query) use ($permission) {
            $query->select("permission_profile.profile_id");
            $query->from("permission_profile");
            $query->whereRaw("permission_profile.permission_id = {$permission->id}");
        })->get();

        $title = "Vincular Perfil a Permissão: {$permission->name}";

        return view('painel.permissions.profile-add',[
            'permission' => $permission,
            'profiles'      => $profiles,
            'title'      => $title
        ]);

    }//profilesAdd

    public function profilesAddPermission($id) {

        $permission = $this->model->find($id);

        $permission->profiles()->attach($this->request->get('profiles'));

        return redirect()->route('permissao.perfis', $id)
                         ->with(['success' => 'Vinculo realizado com sucesso!']);

    }//profileAddPermission

    public function deleteProfile($id, $profileId){
        
        $permission = $this->model->find($id);

        $permission->profiles()->detach($profileId);

        return redirect()->route('permissao.perfis', $id)
                         ->with(['success' => "Perfil do usuário, foi removido com sucesso!"]);
    }//deleteprofile

    public function searchProfile($id) {

        $dataForm = $this->request->except('_token');

        $permission = $this->model->find($id);

        //Filtra os Dados
        $profiles = $permission->profiles()
                               ->where(function($query) use ($dataForm) {$query
                                    ->where('profiles.name', 'like', "%{$dataForm['key-search']}%")
                                    ->orWhere('profiles.label', 'like', "%{$dataForm['key-search']}%");
                                })->paginate($this->totalPage);
        
        return view('painel.permissions.profiles',[
            'profiles'   => $profiles,
            'dataForm'   => $dataForm,
            'permission' => $permission
        ]);
    }//searchProfile

}
