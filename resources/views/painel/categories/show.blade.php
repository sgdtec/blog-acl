@extends('painel.templates.template')

@section('content')

<div class="bred">
<a href="{{url('/painel')}}" class="bred">Home  ></a }}> <a href="{{route('categorias.index')}}" class="bred">Categorias</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Categoria: {{$data->name}}</h1>
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
    <h2><strong>Url:</strong>{{$data->url}}</h2>
    <h2><strong>Descrição:</strong>{{$data->description}}</h2>

    {!! Form::open(['route' => ['categorias.destroy', $data->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::submit("Deletar Categoria:$data->name", ['class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->

@endsection()