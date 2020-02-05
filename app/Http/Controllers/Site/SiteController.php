<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Posts;

class SiteController extends Controller {

    private $category;
    private $post;

    public function __construct(Category $category, Posts $post) {
        $this->category = $category;
        $this->post = $post;
    }
    
    public function index(){

        $title = 'Blog Blingo!';
        $categories = $this->category->all();
        //Pegando os posts marcados como destaque
        $dataPost = $this->post->where('featured', true)
                                ->limit(3)
                                ->orderBy('created_at','DESC')
                                ->get();

        //Pegando os posts
        $posts = $this->post->orderBy('date','DESC')->paginate(5);

        return view('site.home.index', [
            'title' => $title,
            'categories' => $categories,
            'dataPost' => $dataPost,
            'posts' => $posts
        ]);
    }//index

    public function company() {

        $title = 'Blingo Compania!';
        $categories = $this->category->all();

        return view('site.company.company', [
            'title' => $title,
            'categories' => $categories
        ]);
    }//company

    public function contact() {

        $title = 'Blingo Contato!';
        $categories = $this->category->all();

        return view('site.contact.contact', [
            'title' => $title,
            'categories' => $categories
        ]);
    }//contact
}