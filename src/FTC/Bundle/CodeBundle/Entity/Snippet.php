<?php

namespace FTC\Bundle\CodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTC\Bundle\CodeBundle\Entity\Snippet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FTC\Bundle\CodeBundle\Entity\SnippetRepository")
 */
class Snippet
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $code
     *
     * @ORM\Column(name="code", type="text")
     */
    private $code;

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\CodeEntry
     *
     * @ORM\ManyToOne(targetEntity="CodeEntry", inversedBy="snippets")
     */
    protected $entry;

    /**
     * @var \FTC\Bundle\AuthBundle\Entity\User $author
     *
     * @ORM\OneToOne(targetEntity="FTC\Bundle\AuthBundle\Entity\User")
     */
    protected $author;

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\Snippet $parent
     *
     * @ORM\OneToOne(targetEntity="Snippet")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $parent;

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\Comment $comment
     *
     * @ORM\OneToOne(targetEntity="Comment")
     * @ORM\JoinColumn(nullable=true)
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
     * Set name
     *
     * @param string $name
     * @return Snippet
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Snippet
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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