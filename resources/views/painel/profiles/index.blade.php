@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home  ></a }}> 
    <a href="{{url('/painel/perfis')}}" class="bred">Perfis</a>
</div>
    
<div class="title-pg">
    <h1 class="title-pg">Listagem dos Perfis</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
            {!! Form::open(['route' => 'profiles.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('key-search', null, ['class' => 'form-control', 'placeholder' => 'Nome da categoria:']) !!}
                {!! Form::button('Filtrar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
    </div>

    <div class="class-btn-insert">
        <a href="{{route('perfis.create')}}" class="btn-insert">
            <i class="fa fa-user-plus"></i>
            Cadastrar
        </a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
            {!! Session::get('success') !!}
        </div>        
    @endif
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Label</th>
            <th width="250">Ações</th>
        </tr>
        @forelse ($data as $profile)
        <tr>
            <td>{{$profile->name}}</td>
            <td>{{$profile->label}}</td>
            <td>
                <a href="{{route('perfis.edit', $profile->id)}}" class="edit"><span class="glyphicon glyphicon-pencil"></span> Edite</a>
                <a href="{{route('perfis.show', $profile->id)}}" class="delete"><span class="glyphicon glyphicon-eye-open"></span> View</a>
                <a href="{{route('profile.users', $profile->id)}}" class="edit"><span class="fa fa-id-card"></span> Users</a>
            </td>
        </tr>
    @empty
        <p>Nenhum perfil cadastrado!</p>
    @endforelse
    </table>

    {!! $data->appends(isset($dataForm) ? $dataForm : '')->links() !!}

</div><!--Content Dinâmico-->

@endsection