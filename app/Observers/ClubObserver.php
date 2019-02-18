<?php

namespace App\Observers;

use App\Models\Club;
use Illuminate\Support\Facades\Storage;

class ClubObserver
{
    /**
     * Handle the club "created" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function created(Club $club)
    {
        //
    }

    /**
     * Handle the club "updated" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function updated(Club $club)
    {
        //
    }

    /**
     * Handle the club "deleted" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function deleted(Club $club)
    {
        Storage::disk('public')->delete($club->logo);
        Storage::disk('public')->deleteDirectory('clubs/photos/' . $club->id);
    }

    /**
     * Handle the club "restored" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function restored(Club $club)
    {
        //
    }

    /**
     * Handle the club "force deleted" event.
     *
     * @param  \App\Models\Club  $club
     * @return void
     */
    public function forceDeleted(Club $club)
    {
        //
    }
}
