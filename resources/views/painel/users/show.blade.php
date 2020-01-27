@extends('painel.templates.template')

@section('content')

<div class="title-pg">
<h1 class="title-pg">Usuário: {{$user->name}}</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    <h2><strong>Nome:</strong>{{$user->name}}</h2>
    <h2><strong>E-mail:</strong>{{$user->email}}</h2>
    <h2><strong>Facebook:</strong>{{$user->facebook}}</h2>
    <h2><strong>Twitter:</strong>{{$user->twitter}}</h2>
    <h2><strong>Github:</strong>{{$user->github}}</h2>
    <h2><strong>Site:</strong>{{$user->site}}</h2>
    <h2><strong>Bibliografia:</strong>{{$user->bibliograply}}</h2>

    {!! Form::open(['route' => ['usuarios.destroy', $user->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::submit("Deletar Usuário:$user->name", ['class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->

@endsection()