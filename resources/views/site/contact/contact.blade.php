@extends('site.templates.template')

@section('content')

<div class="contact text-center">
	<h1 class="title">Entre em Contato</h1>
	<h2 class="sub-title">Tenha todas as suas Dúvidas esclarecidas pela nossa equipe.</h2>

     {!! Form::open(['route' => 'contact', 'class' => 'form form-contact']) !!}
        {!! Form::text('nome', null , ['placeholder' => 'Seu nome' ]) !!}
        {!! Form::email('email', null , ['placeholder' => 'E-mail']) !!}
        {!! Form::text('assunto', null , ['placeholder' => 'Assunto']) !!}
        {!! Form::textarea('mensagem', null) !!}

        {!! Form::button('Enviar', ['class' => 'btn-contact']) !!}
    {!! Form::close() !!}
</div>

@endsection