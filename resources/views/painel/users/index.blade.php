@extends('painel.templates.template')

@section('content')
    
<div class="title-pg">
    <h1 class="title-pg">Listagem dos Itens</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
            {!! Form::open(['route' => 'usuarios.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('key-search', null, ['class' => 'form-control', 'placeholder' => 'Nome ou E-mail:']) !!}
                {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
    </div>

    <div class="class-btn-insert">
        <a href="{{route('usuarios.create')}}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Facebook</th>
            <th>Twittr</th>
            <th>Github</th>
            <th width="200">Ações</th>
        </tr>

        @forelse ($users as $user)       
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->facebook}}</td>
                <td>{{$user->twitter}}</td>
                <td>{{$user->github}}</td>
                <td>
                    <a href="{{route('usuarios.edit', $user->id)}}" class="edit">Edit</a>
                    <a href="{{route('usuarios.show', $user->id)}}" class="delete">View</a>
                </td>
            </tr>
        @empty
            <p>Nenhum usuário Cadastrado!</p>
        @endforelse
    </table>

    {!! $users->appends(isset($dataForm) ? $dataForm : '')->links() !!}

</div><!--Content Dinâmico-->

@endsection