<?php
namespace FrontBundle\ValueObjects;

/**
 * Describe the object sent to the view, to display the timeline properly
 *
 * Class TimeLineObject
 * @package FrontBundle\ValueObjects
 */
class TimeLineObject
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $videos = [];

    /**
     * @var array
     */
    protected $photos = [];

    /**
     * @var \DateTime
     */
    protected $createdTime;

    /**
     * TimeLineObject constructor.
     * @param $id
     * @param \DateTime $createdTime
     */
    public function __construct($id, \DateTime $createdTime)
    {
        $this->id = $id;
        $this->createdTime = $createdTime;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param array $videos
     */
    public function setVideos($videos)
    {
        $this->videos = $videos;
    }

    /**
     * @param mixed $video
     */
    public function addVideo($video)
    {
        $this->videos[] = $video;
    }

    /**
     * @return array
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param array $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    /**
     * @param mixed $photo
     */
    public function addPhoto($photo)
    {
        $this->photos[] = $photo;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @param \DateTime $createdTime
     */
    public function setCreatedTime($createdTime)
    {
        $this->$createdTime = $createdTime;
    }
}
