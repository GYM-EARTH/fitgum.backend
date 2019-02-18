<?php

namespace App\Listeners;

use App\Events\ClubDeleted as ClubDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class ClubDeleted
{
    /**
     * Handle the event.
     *
     * @param  ClubDeletedEvent  $event
     * @return void
     */
    public function handle(ClubDeletedEvent $event)
    {
        Storage::disk('public')->delete($event->club->logo);
        Storage::disk('public')->deleteDirectory('clubs/' . $event->club->id);
    }
}
