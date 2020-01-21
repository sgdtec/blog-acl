@extends('painel.templates.template')
@section('content')

<div class="title-pg">
    <h1 class="title-pg">Dashboard</h1>
</div>

<div class="content-din">
    
    @for($i = 1; $i <= 12; $i++)
        <div class="col-12 col-sm-4 col-lg-3">
            <div class="rel-dash">
                <i class="fa fa-home" aria-hidden="true"></i>
                <div class="text-rel">
                    <h2 class="result">
                        12
                    </h2>
                    <h3 class="result-ds">
                        Total de Usuários
                    </h3>
                </div>
            </div>
        </div>
   @endfor

</div><!--Content Dinâmico-->    
@endsection