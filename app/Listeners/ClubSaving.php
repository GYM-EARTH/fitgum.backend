<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class ClubSaving
{
    /**
     * Handle the event.
     *
     * @param \App\Events\ClubSaving $event
     * @return void
     */
    public function handle(\App\Events\ClubSaving $event)
    {
        $logoOld = $event->club->getOriginal('logo');
        $logoNew = $event->club->logo;

        if (!empty($logoOld) && $logoOld !== $logoNew) {
            Storage::disk('public')->delete($logoOld);
        }
    }
}
