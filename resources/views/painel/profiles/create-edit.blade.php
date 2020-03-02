@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel/perfis') }}" class="bred">Home  ></a }}> 
    <a href="{{url('painel/create')}}" class="bred">Perfis</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Gestão de Perfis: {{$data->name ?? 'Novo'}}</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    @if (isset($data))
        {!! Form::model($data, ['route' => ['perfis.update', $data->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'perfis.store', 'class' => 'form form-search form-ds']) !!}
    @endif

        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Nome:', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::text('label', null, ['placeholder' => 'Descrição:', 'class' => 'form-control']) !!}
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