@extends('painel.templates.template')

@section('content')

<div class="bred">
<a href="" class="bred">Home  ></a> <a href="{{route('usuarios.index')}}" class="bred">Usuários</a>
</div>
    
<div class="title-pg">
    <h1 class="title-pg">Listagem dos Usuários</h1>
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

    @if (Session::has('success'))
        <div class="alert alert-success hide-msg" style="float: left; with: 100%; margin: 10px 0px;">
            {{ Session::get('success') }}
        </div>        
    @endif
    
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
                    <a href="{{route('usuarios.edit', $user->id)}}" class="edit"><span class="glyphicon glyphicon-pencil"></span> Edite</a>
                    <a href="{{route('usuarios.show', $user->id)}}" class="delete"><span class="glyphicon glyphicon-eye-open"></span> View</a>
                </td>
            </tr>
        @empty
            <p>Nenhum usuário Cadastrado!</p>
        @endforelse
    </table>

    {!! $users->appends(isset($dataForm) ? $dataForm : '')->links() !!}

</div><!--Content Dinâmico-->

@endsection

@section('js')

<script>
    $(function(){
        setTimeout("$('.hide-msg').fadeOut();", 3000)
    });
</script>
    
@endsection