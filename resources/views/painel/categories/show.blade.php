@extends('painel.templates.template')

@section('content')

<div class="bred">
<a href="{{url('/painel')}}" class="bred">Home  ></a }}> <a href="{{route('categorias.index')}}" class="bred">Categorias</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Categoria: {{$cat->name}}</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    <h2><strong>Nome:</strong>{{$cat->name}}</h2>
    <h2><strong>Url:</strong>{{$cat->url}}</h2>
    <h2><strong>Descrição:</strong>{{$cat->description}}</h2>

    {!! Form::open(['route' => ['categorias.destroy', $cat->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) !!}
        <div class="form-group">
            {!! Form::submit("Deletar Categoria:$cat->name", ['class' => 'btn btn-danger']) !!}
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->

@endsection()