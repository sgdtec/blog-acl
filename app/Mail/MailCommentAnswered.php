<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCommentAnswered extends Mailable
{
    use Queueable, SerializesModels;

    public $comment, $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
<<<<<<< HEAD
    public function __construct($comment, $reply)
    {
        $this->comment = $comment;
        $this->reply = $reply;

=======
    public function __construct($comment, $reply) {
        $this->comment = $comment;
        $this->reply = $reply;
>>>>>>> 9b5bcad1e72cad4c94c71814896e16a6bf00a42f
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
<<<<<<< HEAD
            ->subject('Seu comentário foi respondido')
            ->to($this->comment->email)    
            ->view('mails.comments.answer-comment');
=======
                    ->subject('Seu comentário foi respondido')
                    ->to($this->comment->email)
                    ->view('mails.comments.answer_comment');
>>>>>>> 9b5bcad1e72cad4c94c71814896e16a6bf00a42f
    }
}
