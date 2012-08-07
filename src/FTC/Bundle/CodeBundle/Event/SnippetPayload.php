<?php
namespace FTC\Bundle\CodeBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class SnippetPayload extends Event
{

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\Snippet
     */
    protected $snippet;

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->setSnippet($payload);
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
}
