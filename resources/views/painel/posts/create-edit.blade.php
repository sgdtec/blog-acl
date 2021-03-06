@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel/categorias') }}" class="bred">Home  ></a }}> 
    <a href="{{route('posts.create')}}" class="bred">Posts</a>
</div>

<div class="title-pg">
<h1 class="title-pg">Gestão de Post: {{$data->title ?? 'Novo'}}</h1>
</div>

<div class="content-din">
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    @if (isset($data) && !empty($data))
        {!! Form::model($data, ['route' => ['posts.update', $data->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'posts.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
    @endif
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('Titulo:') !!}
                    {!! Form::text('title', null, ['placeholder' => 'Titulo do Post', 'class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('Redline:') !!}
                    {!! Form::text('redline', null, ['maxlength' => '190', 'placeholder' => 'Redline', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('Categoria:') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('Publicar:') !!}
                    {!! Form::date('date', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('Hora:') !!}
                    {!! Form::time('hour', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('Selecione Status:') !!}
                    {!! Form::select('status', ['A' => 'Ativo', 'R' => 'Rascunho'], null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('Descrição:') !!}
                    {!! Form::textarea('description', null, ['placeholder' => 'Descrição breve da Categoria', 'class' => 'form-control bodyPost']) !!}
                </div>
            </div>
        </div>
        
        <div class="row">            
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('Imagem:') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('featured', '1', false) !!}
                        Destaque?
                    </label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::button('Enviar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
</div><!--Content Dinâmico-->
@endsection()

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/aw1c2csvf3e5hfkz8a0p1eiyzvanfvm9yv1hqs98lgloenv6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({       
       selector:'textarea.bodyPost',
       height: 200,
       menubar: false,
       plugins: ['link', 'table','image', 'autoresize', 'lists'],
       toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist'    });
    </script>
@endpush