<?php
namespace FTC\Bundle\CodeBundle\Event;

class CommentPayload
{

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\Comment
     */
    protected $comment;

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->setComment($payload);
    }

    /**
     * @param \FTC\Bundle\CodeBundle\Entity\Comment $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return \FTC\Bundle\CodeBundle\Entity\Comment
     */
    public function getComment()
    {
        return $this->comment;
    }
}
