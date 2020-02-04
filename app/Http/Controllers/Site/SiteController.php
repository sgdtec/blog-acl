<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Posts;

class SiteController extends Controller {

    protected $category;
    protected $post;

    public function __construct(Category $category, Posts $post) {
        $this->category = $category;
        $this->post = $post;
    }
    
    public function index(){

        $title = 'Blog Blingo!';
        $categories = $this->category->all();
        $dataPost = $this->post->where('featured', true)->get();

        return view('site.home.index', [
            'title' => $title,
            'categories' => $categories,
            'dataPost' => $dataPost
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