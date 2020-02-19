<?php

namespace App\Http\Controllers\Painel;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller {

    private $comment;
    private $totalPage = 10;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function index() {

        $data = $this->comment
                     ->where('status', 'R')
                     ->paginate($this->totalPage);

        return view('painel.comments.index', [
            'data' => $data
        ]);
    }

    public function search(Request $request) {

        $dataForm = $request->except('_token');    

        //Filtra os comentários
        if( $dataForm['key-search'] != '') {
            $data = $this->comment->where('status', $dataForm['status'])
                              ->where('name', 'LIKE', "%{$dataForm['key-search']}%")
                              ->orwhere('description', 'LIKE', "%{$dataForm['key-search']}%")
                              ->paginate($this->totalPage);
        } else {

            $data = $this->comment->where('status', $dataForm['status'])
                                  ->paginate($this->totalPage);
        }
        

        $title = "Pesquisa de comentários";                    

        return view("painel.comments.index",[
            'data'     => $data,
            'dataForm' => $dataForm,
            'title'    => $title
        ]);
    }
}
