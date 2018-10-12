<?php

namespace App\Http\Controllers;

use TwitterAPIExchange;

class HomeController extends Controller
{
    /**
     * Display user latest tweet
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        $userTimeline = $this->getUserLatestTweet();

        $tweet = [
            'text' => $userTimeline[0]->text,
            'user_name' => $userTimeline[0]->user->name,
            'created_at' => $userTimeline[0]->created_at,
        ];

        return view('welcome', compact('tweet'));
    }

    /**
     * Returns the user timeline latest tweet
     *
     * @return Json user timeline latest tweet
     **/
    public function getUserLatestTweet()
    {
        $followedUserIds = explode(',', config('services.twitter.follow_user_id'));

        $twitter = new TwitterAPIExchange($this->getTwitterSettings());
        $userTimeline = $twitter
            ->setGetfield("?user_id=" . $followedUserIds[0] . "&count=1")
            ->buildOauth('https://api.twitter.com/1.1/statuses/user_timeline.json', 'GET')
            ->performRequest()
        ;

        return json_decode($userTimeline);
    }

    /**
     * Returns the twitter api settings
     *
     * @return array
     **/
    public function getTwitterSettings()
    {
        return [
            'consumer_key' => config('twitter.consumer_key'),
            'consumer_secret' => config('twitter.consumer_secret'),
            // These two can be left empty since we'll only read from the Twitter's timeline
            'oauth_access_token' => '',
            'oauth_access_token_secret' => '',
        ];
    }
}
