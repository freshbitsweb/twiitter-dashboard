<?php

namespace App\Console\Commands;

use TwitterStreamingApi;
use Illuminate\Console\Command;

class ListenForUserTwit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:listen-for-user-twit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for user twit on Twitter.';

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
        TwitterStreamingApi::publicStream()
            ->whenTweets(config('services.twitter.follow_user_id'), function (array $tweet) {
                // Exclude retweeted twit
                if (array_key_exists('retweeted_status', $tweet)) {
                    return;
                }
            })->startListening()
        ;
    }
}
