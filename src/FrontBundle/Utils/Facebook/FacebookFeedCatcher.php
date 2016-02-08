<?php
namespace FrontBundle\Utils\Facebook;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Facebook\GraphNodes\GraphEdge;
use FrontBundle\ValueObjects\TimeLineObject;

/**
 * Class FacebookFeedCatcher
 * @package FrontBundle\Utils\Facebook
 */
class FacebookFeedCatcher
{
    CONST STATUS_TYPE_PHOTOS = 'added_photos';
    CONST STATUS_TYPE_VIDEO = 'added_video';

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
    protected $facebookAccessToken;

    /**
     * FacebookFeedCatcher constructor.
     * @param FacebookApp $facebookApp
     * @param $facebookPageId
     */
    public function __construct(FacebookApp $facebookApp, $facebookPageId)
    {
        $this->facebookApp = $facebookApp;
        $this->facebookPageId = $facebookPageId;
        $this->facebookAccessToken = $this->facebookApp->getAccessToken();
    }

    /**
     * @return GraphEdge
     */
    public function getFeed()
    {
        $sinceDate = new \DateTime('2016-02-01');
        $request = new FacebookRequest(
            $this->facebookApp,
            $this->facebookAccessToken,
            'GET',
            sprintf('/%d/posts', $this->facebookPageId),
            [
                'fields' => 'message, created_time, status_type, object_id, attachments',
                'since' => $sinceDate->getTimestamp()
            ]
        );

        $fb = new Facebook([
            "app_id" => $this->facebookApp->getId(),
            "app_secret" => $this->facebookApp->getSecret(),
            "default_graph_version" => 'v2.5',
        ]);

        $fb->setDefaultAccessToken($this->facebookAccessToken);

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

        $timelineObject = $this->timelineObjectFiller($response->getGraphEdge());

        return $timelineObject;
    }

    protected function timelineObjectFiller(GraphEdge $graphEdge)
    {
        // Sorry for what's next, but what Facebook api returns is a mess, and the view looks like garbage if we make this work in it

        $timeline = [];
        foreach ($graphEdge as $graphNode) {
            $timelineObject = new TimeLineObject($graphNode['id'], $graphNode['created_time']);

            if (isset($graphNode['message'])) {
                $timelineObject->setMessage($graphNode['message']);
            }

            if (isset($graphNode['attachments'])) {
                $attachments = $graphNode['attachments'];

                foreach($attachments as $attachment) {
                    if ($graphNode['status_type'] === self::STATUS_TYPE_PHOTOS) {
                        // Then the attachment is at least one picture

                        if (isset($attachment['subattachments'])) {
                            // There's actually many pictures
                            foreach($attachment['subattachments'] as $subattachment) {
                                $timelineObject->addPhoto($subattachment['media']['image']['src']);
                            }
                        } else {
                            // There's only one picture
                            $timelineObject->addPhoto($attachment['media']['image']['src']);
                        }
                    }

                    if ($graphNode['status_type'] === self::STATUS_TYPE_VIDEO) {
                        $timelineObject->addVideo($attachment['url']);
                    }
                }
            }

            $timeline[] = $timelineObject;
        }

        return $timeline;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Facebook FeedCatcher';
    }
}
