<?php

namespace App\Listeners;

use App\Events\CommentAnswered;
use App\Mail\MailCommentAnswered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailCommentAnswered {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
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
        Mail::send(new MailCommentAnswered($event->comment(), $event->reply()));
        

    }
}
