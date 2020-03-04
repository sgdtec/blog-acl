@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel/perfis') }}" class="bred">Home  ></a }}> 
    <a href="{{url('painel/perfis')}}" class="bred">Perfis > Gestão Perfil</a>
    <a href="{{route('profile.users', $profile->id)}}" class="bred">> {{$profile->name}}</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Adicionar Novos Usuários ao Perfil: <b>{{$profile->name}}</b></h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif
    
        {!! Form::open(['route' => ['profile.users.add', $profile->id], 'class' => 'form form-search form-ds']) !!}
 
        <div class="form-group">
            @foreach ($users as $user)
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('users[]', $user->id) !!}
                        {{ $user->name }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <div class="form-group">              
             {!! Form::button('Enviar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}                
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->
@endsection()

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
@endpush