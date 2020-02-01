<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller {
    
    public function index(){

        $title = 'Blog Blingo!';

        return view('site.home.index', [
            'title' => $title
        ]);
    }//index

    public function company() {

        $title = 'Blingo Compania!';

        return view('site.company.company', [
            'title' => $title
        ]);
    }//company

    public function contact() {

        $title = 'Blingo Contato!';

        return view('site.contact.contact', [
            'title' => $title
        ]);
    }//contact
}
