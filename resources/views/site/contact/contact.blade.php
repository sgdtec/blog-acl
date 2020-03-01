@extends('site.templates.template')

@section('content')

<div class="contact text-center">
	<h1 class="title">Entre em Contato</h1>
	<h2 class="sub-title">Tenha todas as suas Dúvidas esclarecidas pela nossa equipe.</h2>
     
    @if (Session::has('success'))
            <div class="alert alert-success hide-msg">
                {{ Session::get('success') }}
            </div>        
    @endif

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif
    
     {!! Form::open(['route' => 'contact', 'class' => 'form form-contact']) !!}
        {!! Form::text('name', null , ['placeholder' => 'Seu nome' ]) !!}
        {!! Form::email('email', null , ['placeholder' => 'E-mail']) !!}
        {!! Form::text('subject', null , ['placeholder' => 'Assunto']) !!}
        {!! Form::textarea('message', null) !!}

        {!! Form::button('Enviar', ['type' => 'submit', 'class' => 'btn-contact']) !!}
    {!! Form::close() !!}
</div>

@endsection