<?php
namespace FTC\Bundle\CodeBundle\Entity\Choice;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class CodeEntryTypeChoices extends SimpleChoiceList
{
    const TYPE_IMPROVE_CODE        = 'improvecode';
    const TYPE_IMPROVE_PERFORMANCE = 'betterperformance';
    const TYPE_CODING_HORROR       = 'codinghorror';
    const TYPE_GET_FEEDBACK        = 'feedback';
    const TYPE_CHALLENGE           = 'challenge';

    /**
     * @var array
     */
    protected $reasons;

    /**
     * Redefine Constructor to internalize the creation of the choice list.
     */
    public function __construct()
    {
        $choices = array(
            self::TYPE_IMPROVE_CODE        => 'I want someone to improve this code.',
            self::TYPE_IMPROVE_PERFORMANCE => 'I want someone to make this code faster.',
            self::TYPE_CODING_HORROR       => 'This is a sample of Coding Horror.',
            self::TYPE_GET_FEEDBACK        => 'I want feedback on this code.',
            self::TYPE_CHALLENGE           => 'This code is bulletproof, I dare people to make it better.',
        );

        $this->reasons = array(
            self::TYPE_IMPROVE_CODE        => 'Make this code better',
            self::TYPE_IMPROVE_PERFORMANCE => 'Make this code faster',
            self::TYPE_CODING_HORROR       => 'Coding Horror, don\'t do this at home',
            self::TYPE_GET_FEEDBACK        => 'Give me feedback',
            self::TYPE_CHALLENGE           => 'I dare you to improve this',
        );

        parent::__construct($choices);
    }

    /**
     * Get the text meant for the target user
     *
     * @param $key
     * @return mixed
     */
    public function getTargetUserText($key)
    {
        return $this->reasons[$key];
    }

    /**
     * Get a list of the code categories focused on target users
     *
     * @return array
     */
    public function getTargetUserChoices()
    {
        return $this->reasons;
    }
}
