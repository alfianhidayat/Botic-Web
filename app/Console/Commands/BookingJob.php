<?php

namespace App\Console\Commands;

use App\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BookingJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $booking = Booking::all();
        foreach ($booking as $book) {
            $tomorrow = date('Y-m-d h:i', strtotime(str_replace('-', '/', $book->created_at) . "+1 days"));
            $today = date('Y-m-d h:i');
            if ($today == $tomorrow) {
                $book->booking_status_id = 4;
                $book->save();
            }
        }
    }
}
