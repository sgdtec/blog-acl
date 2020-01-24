@extends('painel.templates.template')

@section('content')
    
<div class="title-pg">
    <h1 class="title-pg">Listagem dos Itens</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
            {!! Form::open(['url', '/painel/usuarios/pesquisar', 'class' => 'form form-inline']) !!}
                {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Home:']) !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail:']) !!}
                {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
    </div>

    <div class="class-btn-insert">
        <a href="{{route('usuarios.create')}}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>facebook</th>
            <th width="150">Ações</th>
        </tr>

        @forelse ($users as $user)       
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->facebook}}</td>
                <td>
                    <a href="" class="edit">Edit</a>
                    <a href="" class="delete">Delete</a>
                </td>
            </tr>
        @empty
            <p>Nenhum usuário Cadastrado!</p>
        @endforelse
    </table>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

</div><!--Content Dinâmico-->

@endsection