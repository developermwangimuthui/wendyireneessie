<?php

namespace App\Jobs;

use App\Http\Controllers\GangsterPointController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GansterCalc implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
                // dd($this->user);

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // echo($this->user);
        // echo('user');
         $calcgangsterPoints = new GangsterPointController();
        $calcgangsterPoints->calculateGangsterPoints($this->user);

    }
}
