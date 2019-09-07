<?php

namespace App\Listeners;

use App\Events\APNFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendAPNFinishedNotification
{
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
     * @param  APNFinished  $event
     * @return void
     */
    public function handle(APNFinished $event)
    {
        //
        Log::debug("APN finished: ".$event->succCount);
    }
}
