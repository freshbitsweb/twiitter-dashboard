<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use TwitterStreamingApi;
use Illuminate\Console\Command;
use App\Events\NewTweetRecived;

class ListenForUserTweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:listen-for-user-tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen for user tweet on Twitter.';

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
                // Exclude retweeted tweet
                if (
                    array_key_exists('retweeted_status', $tweet) ||
                    array_key_exists('delete', $tweet)
                ) {
                    return;
                }

                broadcast(new NewTweetRecived([
                    'text' => $tweet['text'],
                    'created_at' => Carbon::createFromTimeStamp(strtotime($tweet['created_at']))->diffForHumans(),
                ]))->toOthers();
            })->startListening()
        ;
    }
}
