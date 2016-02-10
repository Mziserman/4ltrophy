<?php
namespace FrontBundle\Utils\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class FacebookFeedCatcher
 * @package FrontBundle\Utils\Facebook
 */
class TwitterTweetsCatcher
{
    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $consumerSecret;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $accessTokenSecret;

    /**
     * TwitterTweetsCatcher constructor.
     */
    public function __construct()
    {
        $this->consumerKey = $_SERVER['SYMFONY_TWITTER_CONSUMER_KEY'];
        $this->consumerSecret = $_SERVER['SYMFONY_TWITTER_CONSUMER_SECRET'];
        $this->accessToken = $_SERVER['SYMFONY_TWITTER_ACCESS_TOKEN'];
        $this->accessTokenSecret = $_SERVER['SYMFONY_TWITTER_ACCESS_TOKEN_SECRET'];
    }

    public function getTweets()
    {
        $toa = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $this->accessToken, $this->accessTokenSecret);
        $toa->setTimeouts(10, 15);
        $hashtag = '#4LTrophy';

        $query = [
            'q' => $hashtag,
        ];

        $results = $toa->get('search/tweets', $query);

        return $results->statuses;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Twitter TweetsCatcher';
    }
}
