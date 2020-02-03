@extends('auth.master.template')

@section('content-login')

    {!! Form::open(['url', '/login', 'class' => 'form-login']) !!}
        {!! Form::email('email', null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!}
        {!! Form::password('password', ['placeholder' => 'Senha']) !!}
        {!! Form::submit('Acessar', ['class' => 'btn-login']) !!}
        
        <a href="{{url('/password/reset')}}" class="rel-pass">Recuperar Senha?</a>    
    {!! Form::close() !!}

@endsection