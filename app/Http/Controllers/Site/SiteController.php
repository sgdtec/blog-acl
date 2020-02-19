<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Events\PostViewed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller {

    private $totalPage = 6;
    private $category;
    private $post;

    public function __construct(Category $category, Post $post) {
        $this->category = $category;
        $this->post = $post;
    }
    
    public function index(){

        $title = 'Blog Blingo!';

        //Pegando os posts marcados como destaque
        $dataPost = $this->post->where('featured', true)
                               ->limit(3)
                               ->orderBy('created_at','DESC')
                               ->get();

        //Pegando os posts
        $posts = $this->post->orderBy('date','DESC')->paginate($this->totalPage);

        return view('site.home.index', [
            'title'    => $title,
            'dataPost' => $dataPost,
            'posts'    => $posts
        ]);
    }//index

    public function company() {

        $title = 'Blingo Compania!';

        return view('site.company.company', [
            'title' => $title,
        ]);
    }//company

    public function contact() {

        $title = 'Blingo Contato!';

        return view('site.contact.contact', [
            'title' => $title,
        ]);
    }//contact

    public function category($url) {

        $category =  $this->category->where('url', $url)->get()->first();

        $title = "Categoria {$category->name} - Blingo!";
        $posts = $category->posts()->paginate($this->totalPage);

        return view('site.category.category', [
            'category' => $category,
            'listPost' => $posts,
            'title'    => $title
        ]);
    }//category

    public function post($url) {

        $post = $this->post->where('url', $url)->get()->first();

        $title = "{$post->title} - Blingo!";

        //Traz os posts relacionados da categoria
        $postRel = $this->post->where('id', '>', $post->id)->limit(4)->get();

        //Author do Post
        $author = $post->user;

        //Comecando o evento para atualizar as views do post
        event(new PostViewed($post)); 

        return view('site.post.post', [
            'post'    => $post,
            'title'   => $title,
            'postRel' => $postRel,
            'author'  => $author
        ]);

    }//post

    public function commentPost(Request $request) {
        
        $dataForm = $request->all();

        $comment = new Comment;
        $comment->user_id     = ( auth()->check() ) ? auth()->user()->id : 1;
        $comment->post_id     = $dataForm['post'];
        $comment->name        = $dataForm['name'];
        $comment->email       = $dataForm['email'];
        $comment->description = $dataForm['description'];
        $comment->date        = date('Y-m-d');
        $comment->hour        = date('H:i:s');
        $comment->status      = 'R';

        if ($comment->save())
            return '1';
        else
            return 'Falha ao cadastrar comentário, tente novamente...';
        
    }//commentPost
}