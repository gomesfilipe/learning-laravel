<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

// Implementando a interface ShouldQueue os eventos executam de modo assíncrono
class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsSeriesCreated $event): void
    {
        $userList = User::all();
        foreach($userList as $index => $user) {
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason,
            );

            // Mail::to($user)->send($email); // Síncrono
            // sleep(2);
            // Mail::to($user)->queue($email); // Assíncrono
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email); // Agendando o job
        }
    }
}
