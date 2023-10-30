<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncreaseCounter
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
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this ->updateViewer($event->video);
    }
    function updateViewer($video) {
    $video ->viewer=$video ->viewer + 1;
    $video->save();
    }
}