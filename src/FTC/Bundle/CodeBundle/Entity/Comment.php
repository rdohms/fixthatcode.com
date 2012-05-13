<?php

namespace FTC\Bundle\CodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var \FTC\Bundle\CodeBundle\Entity\Snippet $snippet
     *
     * @ORM\OneToOne(targetEntity="Snippet", mappedBy="comment", cascade="none")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $snippet;

    /**
     * @var ArrayCollection $votes
     *
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="comment")
     */
    protected $votes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->votes = new ArrayCollection();
    }

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

    /**
     * @param \FTC\Bundle\CodeBundle\Entity\Snippet $snippet
     */
    public function setSnippet($snippet)
    {
        $this->snippet = $snippet;
    }

    /**
     * @return \FTC\Bundle\CodeBundle\Entity\Snippet
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * Returns a summary of the votes up/down/total
     *
     * @return \stdClass
     */
    public function getVoteSum()
    {
        $votesStats = new \stdClass();
        $votesStats->up    = 0;
        $votesStats->down  = 0;
        $votesStats->total = 0;

        $counter = function ($vote) use ($votesStats) {
            if ($vote->getValue()) {
                $votesStats->up++;
            } else {
                $votesStats->down++;
            }

            $votesStats->total += $vote->getValue();
        };

        $this->votes->map($counter);

        return $votesStats;
    }
}