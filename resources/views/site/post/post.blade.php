@extends('site.templates.template')

@section('content') 

<div class="category">
	
	<section class="content">
		<div class="col-md-8">
			
			<article class="post">
				<div class="image-post text-center">
					<img src="{{url("assets/uploads/posts/{$post->image}")}}" alt="{{$post->title}}" class="img-post">
				</div>
				<div class="description-post-pg text-justify">
					<p class="details-post">
					<span>Autor:</span> {{$author->name}} / <span>Data publicação</span>: <time datetime="{{$post->date}}{{$post->hour}}">{{ \Carbon\Carbon::parse($post->date)->format('d/m/Y')}}</time>
					/ <span>Views:</span> {{ $post->views()->count() }} <span>	
					</p>

					<h2 class="title-post-pg">{{$post->title}}</h2>

					{!! $post->description !!}
				</div>
			</article><!--End Post-->

			<article class="post comments">
				<h2 class="title-comment">Deixe o seu comentário</h2>

				{!! Form::open(['route' => 'comment', 'class' => 'form form-contact form-comment']) !!}
					{!! Form::hidden('post', $post->id) !!}
					{!! Form::text('name', null, ['placeholder' => 'Nome:']) !!}
					{!! Form::email('email', null, ['placeholder' => 'E-mail:']) !!}
					{!! Form::textarea('description', null, ['placeholder' => 'Comente aqui...']) !!}
					
					<button>Enviar</button>
					<div class="preloader" style="display: none;">Enviando Comentário...</div>
					<div class="alert alert-success" style="display: none;">Comentário enviado com sucesso!!!</div>
					<div class="alert alert-danger" style="display: none;"></div>
				{!! Form::close() !!}


				<div class="comment">
					<div class="col-md-2 text-center">
						<img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira" class="user-comment-img img-circle">
					</div>
					<div class="col-md-10 comment-user">
						<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
					</div>
				</div>

				<div class="comment">
					<div class="col-md-2 text-center">
						<img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira" class="user-comment-img img-circle">
					</div>
					<div class="col-md-10 comment-user">
						<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
					</div>
				</div>
				<div class="reply-comment">
					<div class="col-md-2 text-center">
						<img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira" class="user-comment-img img-circle">
					</div>
					<div class="col-md-10 comment-user">
						<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
					</div>
				</div>
				<div class="reply-comment">
					<div class="col-md-2 text-center">
						<img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira" class="user-comment-img img-circle">
					</div>
					<div class="col-md-10 comment-user">
						<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
					</div>
				</div>

				<div class="comment">
					<div class="col-md-2 text-center">
						<img src="imgs/user-carlos-ferreira.png" alt="Carlos Ferreira" class="user-comment-img img-circle">
					</div>
					<div class="col-md-10 comment-user">
						<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.</p>
					</div>
				</div>
			</article>


		</div><!--POSTS-->

		<!--Sidebar-->
		@include('site.includes.sidebar')
	</section>

	@if (isset($postRel) && empty($postRel))				
		<section class="post-relation">
			<h1 class="title-post-rel">Posts Relacionados:</h1>
			
			@foreach ( $postRel as $post )		
				<article class="post-rel col-md-3 col-xm-6 col-sm-12">
					<a href="{{route('post', $post->url)}}">
						<div class="image-post text-center">
							<img src="{{url("assets/uploads/posts/{$post->image}")}}" alt="{{$post->title}}}}" class="img-post">
						</div>
						<div class="description-post">
							<h2 class="title-post-rel-list">{{$post->title}}</h2>
						</div>
					</a>
				</article>
			@endforeach
		</section>
	@endif
</div>
@endsection

@push('scripts')
	<script>
		$(function(){
			$('form.form-comment').submit(function(event){
				event.preventDefault();

				$('.alert-success').hide();
				$('.alert-danger').hide();

				var dataForm = $(this).serialize();

				$.ajax({
					url: '/comment-post',
					method: 'POST',
					data: dataForm,
					beforeSend: startPreloader()

				}).done(function(data){
					
					if ( data == '1') {
						$('.alert-success').fadeIn();
					} else {
						$('.alert-danger').fadeIn();						
						$('.alert-danger').html(data);
					}

					endPreloader()
					hideMsg();

				}).fail(function() {
					alert('Falha ao enviar os dados...')
					endPreloader()
				});
			});

			function startPreloader() {
				$('.preloader').show();
			}

			function endPreloader() {
				$('.preloader').hide();
			}

			function hideMsg() {
				$('form.form-comment')[0].reset();
				setTimeout("$('.alert').hide();", 3000);
			}
		});
	</script>
@endpush