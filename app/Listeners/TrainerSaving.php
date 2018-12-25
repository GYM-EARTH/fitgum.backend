<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class TrainerSaving
{
    /**
     * Handle the event.
     *
     * @param \App\Events\TrainerSaving $event
     * @return void
     */
    public function handle(\App\Events\TrainerSaving $event)
    {
        $photoOld = $event->trainer->getOriginal('photo');
        $photoNew = $event->trainer->photo;

        if (!empty($photoOld) && $photoOld !== $photoNew) {
            Storage::disk('public')->delete($photoOld);
        }
    }
}
