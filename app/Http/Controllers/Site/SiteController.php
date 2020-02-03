<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class SiteController extends Controller {

    protected $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }
    
    public function index(){

        $title = 'Blog Blingo!';
        $categories = $this->category->all();

        return view('site.home.index', [
            'title' => $title,
            'categories' => $categories
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