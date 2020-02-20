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
        return $this->hasOne(CommentAnswer::class)
                    ->join('users', 'users.id', '=', 'comment_answers.user_id')
                    ->select('comment_answers.id','comment_answers.description', 'users.image as image_user', 'users.name');
    }
}
