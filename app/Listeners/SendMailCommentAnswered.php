<?php

namespace App\Listeners;

use Mail;
use App\Events\CommentAnswered;
use App\Mail\MailCommentAnswered;
<<<<<<< HEAD
use Illuminate\Support\Facades\Mail;
=======
>>>>>>> 9b5bcad1e72cad4c94c71814896e16a6bf00a42f
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailCommentAnswered {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentAnswer  $event
     * @return void
     */
    public function handle(CommentAnswered $event)
    {
<<<<<<< HEAD
        Mail::send(new MailCommentAnswered($event->comment(), $event->reply()));
        

=======
       Mail::send(new MailCommentAnswered($event->comment(), $event->reply())); 
>>>>>>> 9b5bcad1e72cad4c94c71814896e16a6bf00a42f
    }
}