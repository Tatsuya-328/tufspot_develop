<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\ReservationPost;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class reservationPostUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reservation-post-up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute reservation post';

    const PUBLIC = 1;
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month < 10 ? '0' . $now->month : $now->month;
        $day = $now->day < 10 ? '0' . $now->day : $now->day;
        $hour = $now->hour < 10 ? '0' . $now->hour : $now->hour;
        $min = $now->minute < 10 ? '0' . $now->minute : $now->minute;
        $date = $year . $month . $day;
        $time = $hour . $min . '00';

        $reserved_posts = ReservationPost::where('date', '<=', $date)->where('time', '<=', $time)->get();

        foreach ($reserved_posts as $reserved_post) {
            $reserved_post->post->update([
                'is_public' => self::PUBLIC,
            ]);
            $reserved_post->delete();
        }
    }
}
