<?php

namespace App\Listeners;

use App\Events\LessonsWasDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailLessonDeletedListener implements ShouldQueue //تنفيذ بشكل غير متزامن
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
     * @param  LessonsWasDeleted  $event
     * @return void
     */
    public function handle(LessonsWasDeleted $event)
    {
        var_dump("the lesson with title" . $event->lesson->title . "was deleted");
    }
}
