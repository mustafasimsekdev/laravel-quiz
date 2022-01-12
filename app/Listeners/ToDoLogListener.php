<?php

namespace App\Listeners;

use App\Events\ToDoLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ToDoLogListener
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
    public function handle(ToDoLogEvent $event)
    {
        DB::table('to_does_log')->insert([
            'content' => $event->content,
            'recording_name' => $event->rName,
            'state' => $event->state,
        ]);
    }
}
