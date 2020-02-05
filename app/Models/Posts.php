<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {

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

};
