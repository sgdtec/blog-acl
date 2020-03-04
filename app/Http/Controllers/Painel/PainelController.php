<?php

namespace App\Http\Controllers\Painel;

use App\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PainelController extends Controller {

   public function index() {

       $totalUser       = User::count();
       $totalCategories = Category::count();
       $totalPosts      = Post::count();
       $totalComments   = Comment::where('status', 'R')->count();
       $totalProfiles   = Profile::count();
       $totalPermission = Permission::count();
       
       return view('painel.home.index', [
           'totalUser'        => $totalUser,
           'totalCategories'  => $totalCategories,
           'totalPosts'       => $totalPosts,
           'totalComments'    => $totalComments,
           'totalProfiles'    => $totalProfiles,
           'totalPermission' =>  $totalPermission

       ]);
   }
}
