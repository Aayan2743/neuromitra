<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Adjust according to your model
use App\Notifications\FcmNotification;
use Carbon\Carbon;


class SendScheduledFcmNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:fcm-notification';
    protected $description = 'Send FCM notification 30 minutes before a specific date and time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
