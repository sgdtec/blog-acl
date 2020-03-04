@extends('painel.templates.template')

@section('content')

<div class="title-pg">
    <h1 class="title-pg">Dashboard</h1>
</div>

<div class="content-din">
    <div class="col-12 col-sm-4 col-lg-3">
        <div class="rel-dash">
            <i class="fa fa-id-card" aria-hidden="true"></i>
            <div class="text-rel">
                <h2 class="result">
                    {{ $totalUser }}
                </h2>
                <h3 class="result-ds">
                    Total de Usuários
                </h3>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-3">
        <div class="rel-dash">
            <i class="fa fa-cubes" aria-hidden="true"></i>
            <div class="text-rel">
                <h2 class="result">
                    {{ $totalCategories }}
                </h2>
                <h3 class="result-ds">
                    Total de Categorias
                </h3>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-3">
        <div class="rel-dash">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <div class="text-rel">
                <h2 class="result">
                    {{ $totalPosts }}
                </h2>
                <h3 class="result-ds">
                    Total de Posts
                </h3>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-3">
        <div class="rel-dash">
            <i class="fa fa-comments" aria-hidden="true"></i>
            <div class="text-rel">
                <h2 class="result">
                     {{ $totalComments }}
                </h2>
                <h3 class="result-ds">
                    Total de Comentários
                </h3>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-3">
        <div class="rel-dash">
            <i class="fa fa-users" aria-hidden="true"></i>
            <div class="text-rel">
                <h2 class="result">
                    {{ $totalProfiles }}
                </h2>
                <h3 class="result-ds">
                    Total de Perfis
                </h3>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-3">
        <div class="rel-dash">
            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
            <div class="text-rel">
                <h2 class="result">
                    {{ $totalPermission }}
                </h2>
                <h3 class="result-ds">
                    Total de Permissões
                </h3>
            </div>
        </div>
    </div>

    
    

</div><!--Content Dinâmico-->    
@endsection