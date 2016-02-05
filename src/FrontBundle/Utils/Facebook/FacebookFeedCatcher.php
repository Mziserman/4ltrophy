<?php
namespace FrontBundle\Utils\Facebook;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Facebook\GraphNodes\GraphEdge;

/**
 * Class FacebookFeedCatcher
 * @package FrontBundle\Utils\Facebook
 */
class FacebookFeedCatcher
{
    /**
     * @var FacebookApp
     */
    protected $facebookApp;

    /**
     * @var string
     */
    protected $facebookPageId;

    /**
     * @var string
     */
    protected $facebookUserToken;

    /**
     * FacebookFeedCatcher constructor.
     * @param FacebookApp $facebookApp
     * @param $facebookPageId
     */
    public function __construct(FacebookApp $facebookApp, $facebookPageId)
    {
        $this->facebookApp = $facebookApp;
        $this->facebookPageId = $facebookPageId;
        $this->facebookUserToken = $this->facebookApp->getAccessToken();
    }

    /**
     * @return GraphEdge
     */
    public function getFeed()
    {
        $request = new FacebookRequest(
            $this->facebookApp,
            $this->facebookUserToken,
            'GET',
            sprintf('/%d/feed', $this->facebookPageId),
            [
                'fields' => 'picture, message, created_time, full_picture',
            ]
        );

        $fb = new Facebook([
            "app_id" => $this->facebookApp->getId(),
            "app_secret" => $this->facebookApp->getSecret(),
        ]);

        try {
            $response = $fb->getClient()->sendRequest($request);
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            dump( 'Graph returned an error: ' . $e->getMessage());
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            dump( 'Facebook SDK returned an error: ' . $e->getMessage());
            exit;
        }

        return $response->getGraphEdge();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Facebook FeedCatcher';
    }
}
