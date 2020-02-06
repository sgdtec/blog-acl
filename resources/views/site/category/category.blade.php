@extends('site.templates.template')

@section('content') 

<div class="slide">

<section class="content">

<div class="category">
    <div class="col-md-8">
        <div class="title-category">
            <h1 class="title-category">{{$category->name}}</h1>
        </div>

        @foreach ( $listPost as $post )
            <article class="post">
                <div class="image-post col-md-4 text-center">
                <img src="{{ url("assets/uploads/posts/{$post->image}") }}" alt="Nome Post" class="img-post">
                </div>
                <div class="description-post col-md-8">
                    <h2 class="title-post">{{$post->title}}</h2>

                    <p class="description-post">
                        {!! $post->description !!}
                    </p>

                    <a class="btn-post" href="{{url("/tutorial/{$post->url}")}}">Ir <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </article>
        @endforeach

        <div class="pagination-posts">
            {{ $listPost->links() }}
        </div>

    </div><!--POSTS-->
    @include('site.includes.sidebar')    
</section>
</div>
@endsection