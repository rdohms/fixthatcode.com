<?php

namespace FTC\Bundle\CodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTC\Bundle\CodeBundle\Entity\Vote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FTC\Bundle\CodeBundle\Entity\VoteRepository")
 */
class Vote
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
     * @var float $value
     *
     * @ORM\Column(name="value", type="float")
     */
    protected $value;

    /**
     * @var \FTC\Bundle\AuthBundle\Entity\User $user
     *
     * @ORM\ManyToOne(targetEntity="\FTC\Bundle\AuthBundle\Entity\User")
     */
    protected $user;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="votes")
     */
    protected $comment;
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
     * Set value
     *
     * @param float $value
     * @return float
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param  $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param \FTC\Bundle\AuthBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \FTC\Bundle\AuthBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}