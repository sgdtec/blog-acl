<?php

namespace App\Models;

use App\User;
use App\Models\CommentAnswer;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Trazendo usuário do comment
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Trazendo todas resposta de um comment
    public function answers() {
        return $this->hasMany(CommentAnswer::class)
                    ->join('users', 'users.id', '=', 'comment_answers.user_id')
                    ->select('comment_answers.id','comment_answers.description', 'users.image as image_user', 'users.name');
    }

    public function rulesAnswerComment() {
        return  [
            'description' => 'required:min:3|max:1000'
        ];
    }

    //Validando Comment Front
    public function rules() {
        return [
            'name'        => 'required|min:3|max:100',
            'email'       => 'required|email|min:3|max:100',
            'description' => 'required|min:3|max:1000'
        ];
    }
    
    public function newComment($dataForm) {
       
        $this->user_id     = ( auth()->check() ) ? auth()->user()->id : 1;
        $this->post_id     = $dataForm['post'];
        $this->name        = $dataForm['name'];
        $this->email       = $dataForm['email'];
        $this->description = $dataForm['description'];
        $this->date        = date('Y-m-d');
        $this->hour        = date('H:i:s');
        $this->status      = 'R';

        return $this->save(); 
    }
}
