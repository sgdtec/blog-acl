<?php

namespace App\Http\Controllers\Painel;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\CommentAnswer;
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
        if( isset($dataForm['key-search']) && $dataForm['key-search'] != '') {
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

    public function answers ($id) {
        
        $comment = $this->comment->find($id);
        $answers = $comment->answers()->get(); 
        
        $title = "Respostas Comentário : $comment->name";
        
        return view('painel.comments.answers', [
            'comment' => $comment,
            'answers' => $answers,
            'title'   => $title
        ]); 
    }

    //Responder comentario
    public function answerComment(Request $request, $id) {

        //Validando o campo 
        $this->validate($request, [
            'description' => 'required|min:3|max:1000'
        ]);

        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $dataForm['date']    = date('Y-m-d');
        $dataForm['hour']    = date('H:i:s');
       
        $comment = $this->comment->find($id);
        $comment->status = 'A';
        $comment->save();

        $insert =$comment->answers()->create($dataForm);

        if($insert)
          return redirect()->back()
                           ->with(['success' => 'Comentário gravado com sucesso!']);
        else
           return redirect()->back()
                            ->withErrors(['errors' => 'Erro ao gravar o comentário...'])
                            ->withInput();



    }

    //Deletando comentário
    public function destroy($id) {
        
        $data = $this->comment->find($id);

        $delete = $data->delete();

        if($delete)
            return redirect()->route('comments')
                             ->with(['sucecess' => 'O comentário foi excluido com sucesso!']);
        else
            return redirect()->back()
                             ->withErrors(['errors' => 'Falha ao excluir o comnetário, tente novamente...']);                   
    }

    //Deletando resposta comentário
    public function destroyAnswer($idid, $idAnswer) {

        //Pegando as respostas
        $answerComment = CommentAnswer::find($idAnswer);

        $delete = $answerComment->delete();

        if($delete)
            return redirect()->back()
                             ->with(['sucecess' => 'Resposta foi excluida com sucesso!']);
        else
            return redirect()->back()
                             ->withErrors(['errors' => 'Falha ao excluir a resposta, tente novamente...']);                   
     
    } 

}
