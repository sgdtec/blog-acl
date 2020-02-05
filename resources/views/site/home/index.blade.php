@extends('site.templates.template')

@section('content') 

<div class="slide">
    <div class="col-md-8">
        @foreach ($dataPost as $post)   

            @if ( $loop->first)            
                <article class="img-big">
                    <a href="{{url('/artigol/{$post->url}')}}" title="{{ $post->title }}">
                        <img src="{{ url("assets/uploads/posts/{$post->image}") }}" alt="{{ $post->image }}" class="img-slide-small">
                        <h1 class="text-slide">
                            {{ $post->redline }}
                        </h1>
                    </a>
                </article>
            @else
                <article class="img-small col-md-12 col-sm-6 col-xm-12">
                    <a href="{{url('/artigol/{$post->url}')}}" title="{{ $post->title }}">
                        <img src="{{ url("assets/uploads/posts/{$post->image}") }}" alt="{{ $post->image }}" class="img-slide-small">
                        <h1 class="text-slide">
                            {{ $post->redline }}
                        </h1>
                    </a>
                </article>            
            @endif

            @if ($loop->first)
            </div><!--close col-md-8-->
            <div class="col-md-4">
            @endif
        @endforeach    
    </div><!--close col-md-4-->       
</div><!--Slide-->


<section class="content">
    <div class="col-md-8">

        @foreach ( $posts as $listPost )
            <article class="post">
                <div class="image-post col-md-4 text-center">
                <img src="{{ url("assets/uploads/posts/{$listPost->image}") }}" alt="Nome Post" class="img-post">
                </div>
                <div class="description-post col-md-8">
                    <h2 class="title-post">{{$listPost->title}}</h2>

                    <p class="description-post">
                        {!! $listPost->description !!}
                    </p>

                    <a class="btn-post" href="{{url("/artigo/{$listPost->redline}")}}">Ir <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </article>
        @endforeach

        <div class="pagination-posts">
            {{ $posts->links() }}
        </div>

    </div><!--POSTS-->

    <!--Sidebar-->
    <div class="col-md-4">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fespecializati&tabs&width=340&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div><!--Sidebar-->
</section>
@endsection