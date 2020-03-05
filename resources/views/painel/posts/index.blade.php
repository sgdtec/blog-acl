@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home ></a }}>
    <a href="{{route('posts.index')}}" class="bred">Posts</a>
</div>
    
<div class="title-pg">
    <h1 class="title-pg">Listagem dos Posts</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
            {!! Form::open(['route' => 'posts.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('key-search', null, ['class' => 'form-control', 'placeholder' => 'Nome do Post:']) !!}
                {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
    </div>

    <div class="class-btn-insert">
        <a href="{{route('posts.create')}}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
            {!! Session::get('success') !!}
        </div>        
    @endif
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Modo</th>
            <th width="200">Ações</th>
        </tr>
        @foreach ($data as $post)                    
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->status == 'A' ? 'Postado' : 'Rascunho'}}</td>
                    <td>
                        @can('update', $post)
                            <a href="{{route('posts.edit', $post->id)}}" class="edit"><span class="glyphicon glyphicon-pencil"></span> Edite</a>
                        @endcan   
                        <a href="{{route('posts.show', $post->id)}}" class="delete"><span class="glyphicon glyphicon-eye-open"></span> View</a>
                    </td>
                </tr>
        @endforeach
    </table>

    {!! $data->appends(isset($dataForm) ? $dataForm : '')->links() !!}

</div><!--Content Dinâmico-->

@endsection