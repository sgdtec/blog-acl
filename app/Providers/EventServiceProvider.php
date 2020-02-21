<?php

namespace App\Providers;

use App\Events\PostViewed;
use App\Events\CommentAnswered;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\IncrementsPostViewed;
use App\Listeners\SendMailCommentAnswered;
use App\Listeners\ChangeStatusCommentAnswered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
            PostViewed::class => [
                IncrementsPostViewed::class,
            ],
            CommentAnswered::class => [
                SendMailCommentAnswered::class,
                ChangeStatusCommentAnswered::class
            ]        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
