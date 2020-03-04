@extends('painel.templates.template')

@section('content')

<div class="bred">
<a href="{{url('/painel')}}" class="bred">Home  ></a }}> <a href="{{url('/painel/index')}}" class="bred">Permissão</a>
<a href="{{url('painel/permissoes')}}" class="bred">Permissões > Lista da Permissão</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Permissão: {{$data->name}}</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    <h2><strong>Nome:</strong>{{$data->name}}</h2>
    <h2><strong>Label:</strong>{{$data->label}}</h2>

    {!! Form::open(['route' => ['permissoes.destroy', $data->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::button("Deletar Permissão:$data->name", ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->

@endsection()