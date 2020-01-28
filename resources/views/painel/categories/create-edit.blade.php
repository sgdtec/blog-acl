@extends('painel.templates.template')

@section('content')

<div class="bred">
<a href="{{url('/painel/categorias') }}" class="bred">Home  ></a }}> <a href="{{route('categorias.create')}}" class="bred">Categorias</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Gestão de Categorias: {{$cat->name ?? 'Novo'}}</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    @if (isset($cat))
        {!! Form::model($cat, ['route' => ['categorias.update', $cat->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'categorias.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
    @endif

        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Nome da Categoria', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('url', null, ['placeholder' => 'Url da Categoria', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::textarea('description', null, ['placeholder' => 'Descrição breve da Categoria', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->
@endsection()