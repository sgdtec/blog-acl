@extends('painel.templates.template')

@section('content')

<div class="bred">
    <a href="{{url('/painel')}}" class="bred">Home ></a }}>
    <a href="{{route('comments')}}" class="bred">Comentários</a>
</div>
    
<div class="title-pg">
    <h1 class="title-pg">
         Listagem das respostas: <b>{{$comment->name}} - {{ $comment->description }}</b>
    </h1>
</div>

{!! Form::open(['route' => ['destroy.comment', $comment->id]]) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}

<div class="content-din bg-white">

    <table class="table table-striped">
        <tr>
            <th width="30">#</th>
            <th width="120">Nome</th>
            <th>Resposta</th>
            <th width="200">Ações</th>
        </tr>
        @foreach ($answers as $answer)
            <tr>
                <td>{{$answer->id}}</td>                
                <td>{{$answer->name}}</td>
                <td>{{$answer->description}}</td>
                <td>
                    <a href="{{ route('destroy.answer', ['id' => $comment->id, 'idAnswer' => $answer->id] )}}" class="delete"><span class="fa fa-trash-o"></span> Deletar</a>
                </td>
            </tr>
        @endforeach
    </table>

    @if (Session::has('success'))
        <div class="alert alert-success hide-msg" style="float: left; width: 100%; margin: 10px 0px;">
            {!! Session::get('success') !!}
        </div>        
    @endif

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>        
    @endif

    <div class="form-search">
        {!! Form::open(['route' => ['answer.comment', $comment->id ], 'class' => 'form']) !!}
            <div class="form-group">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Responder aqui...']) !!}
            </div>
            {!! Form::submit('Enviar Resposta', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div><!--Content Dinâmico-->

@endsection