<?php

namespace App\Providers;

use App\User;
use App\Models\Post;
use App\Models\Permission;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Verificar os dados de quem está logado
        Gate::define('owner', function(User $user, $data){
            return $user->id == $data->user_id;
        });


        //Verifica se pode editar
        Gate::define('update_profile', function(User $user, $id){
            return $user->id == $id;
        });

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
               return $user->hasPermission($permission);
            });
        }

        //Libera Todos os acessos para o Admin.
        Gate::before(function(User $user, $ability){
           if( $user->hasProfile('Admin'))
                return true;
        });
    }
}