@extends('painel.templates.template')

@section('content')

<div class="title-pg">
    <h1 class="title-pg">Gestão de Usuários</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    {!! Form::open(['url' => '/painel/usuarios', 'class' => 'form form-search form-ds', 'files' => true]) !!}

        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::email('email', null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::password('password', ['placeholder' => 'Senha', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::password('password_confimation', ['placeholder' => 'Confirmar senha', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('facebook', null,  ['placeholder' => 'Facebook', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('twitter', null,  ['placeholder' => 'Twitter', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('site', null, ['placeholder' => 'Site', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('github', null, ['placeholder' => 'Github', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::textarea('bibliograply', null, ['placeholder' => 'Bibliografia', 'class' => 'form-control']) !!}
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