<?php

namespace FTC\Bundle\CodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTC\Bundle\CodeBundle\Entity\Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FTC\Bundle\CodeBundle\Entity\CommentRepository")
 */
class Comment
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="text")
     */
    protected $comment;

    /**
     * @var \FTC\Bundle\AuthBundle\Entity\User $author
     *
     * @ORM\ManyToOne(targetEntity="\FTC\Bundle\AuthBundle\Entity\User")
     */
    protected $author;

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\CodeEntry
     *
     * @ORM\ManyToOne(targetEntity="CodeEntry", inversedBy="comments")
     */
    protected $entry;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param \FTC\Bundle\AuthBundle\Entity\User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return \FTC\Bundle\AuthBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \FTC\Bundle\CodeBundle\Entity\CodeEntry $entry
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;
    }

    /**
     * @return \FTC\Bundle\CodeBundle\Entity\CodeEntry
     */
    public function getEntry()
    {
        return $this->entry;
    }
}