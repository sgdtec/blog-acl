@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home ></a }}>
    <a href="{{route('painel.comment')}}" class="bred">Comentários</a>
</div>
    
<div class="title-pg">
    <h1 class="title-pg">Listagem dos Comentários</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
            {!! Form::open(['route' => 'comments.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('key-search', isset($dataForm['key-search']) ? $dataForm['key-search'] : null, ['class' => 'form-control', 'placeholder' => 'Nome do Post:']) !!}
                {!! Form::select('status', ['R' => 'Rascunho', 'A' => 'Respondidos'], isset($dataForm['status']) ? $dataForm['status'] : null , ['class' => 'form-control']) !!}
                {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
            {!! Session::get('success') !!}
        </div>        
    @endif
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Comentário</th>
            <th width="200">Ações</th>
        </tr>
        @foreach ($data as $comment)       
            <tr>
                <td>{{$comment->name}}</td>
                <td>{{$comment->description}}</td>
                <td>
                    <a href="{{}}" class="delete"><span class="fa fa-reply-all"></span> Responder</a>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->appends(isset($dataForm) ? $dataForm : '')->links() !!}

</div><!--Content Dinâmico-->

@endsection