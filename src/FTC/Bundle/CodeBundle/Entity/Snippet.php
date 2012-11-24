<?php

namespace FTC\Bundle\CodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    private $name;

    /**
     * @var string $language
     *
     * @ORM\Column(name="language", type="string", length=10)
     * @Assert\NotBlank()
     */
    protected $language;

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
     * @ORM\ManyToOne(targetEntity="FTC\Bundle\AuthBundle\Entity\User")
     */
    protected $author;

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\Snippet $parent
     *
     * @ORM\ManyToOne(targetEntity="Snippet")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $parent;

    /**
     * @var string $diff
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $diff;

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\Comment $comment
     *
     * @ORM\OneToOne(targetEntity="Comment", inversedBy="snippet", cascade={"persist", "remove", "merge"})
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

    /**
     * @param \FTC\Bundle\CodeBundle\Entity\Snippet $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return \FTC\Bundle\CodeBundle\Entity\Snippet
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Returns the extension of a file
     *
     * @return string
     */
    public function getExtension()
    {
        return pathinfo($this->getName(), PATHINFO_EXTENSION) ?: 'text';
    }

    /**
     * @param string $diff
     */
    public function setDiff($diff)
    {
        $this->diff = $diff;
    }

    /**
     * @return string
     */
    public function getDiff()
    {
        return $this->diff;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
