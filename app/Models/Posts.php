<?php

namespace App\Models;
use App\User;

use Carbon\Carbon;
use App\Models\PostView;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = ['posts'];

    protected $fillable = [
       'title', 
       'redline',
       'user_id', 
       'category_id', 
       'description', 
       'date', 
       'hour', 
       'featured', 
       'status',
       'image', 
    ];//fillable
   

    public function rules($id = '') {

       return [
            'title'       => "required|min:3|max:100,unique:posts,title,{$id},id",
            'redline'     => "required|min:3|max:100,unique:posts,redline,{$id},id",
            'category_id' => 'required', 
            'description' => 'required|min:50|max:6000', 
            'date'        => 'required|date', 
            'hour'        => 'required',
            'status'      => 'required|in:A,R', 
            'image'       => 'image',
       ];
    }//rules

    //Limitando a quantidade de palavras no post.
    public function getDescriptionAttribute($value) {
      return str::limit($value, 200, '...');
    }
   
    //Carrega os posts do criador do post
    public function user() {
         return $this->belongsTo(User::class);
    }

    //Trazendo a quantidade de visualizações do post
    public function views() {
       return $this->hasMany(PostView::class);
    }

};
