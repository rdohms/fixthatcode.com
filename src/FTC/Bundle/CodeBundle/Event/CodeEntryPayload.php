<?php
namespace FTC\Bundle\CodeBundle\Event;

class CodeEntryPayload
{

    /**
     * @var \FTC\Bundle\CodeBundle\Entity\CodeEntry
     */
    protected $entry;

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->setEntry($payload);
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
