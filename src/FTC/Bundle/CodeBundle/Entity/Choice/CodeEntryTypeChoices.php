<?php
namespace FTC\Bundle\CodeBundle\Entity\Choice;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class CodeEntryTypeChoices extends SimpleChoiceList
{
    /**
     * Redefine Constructor to internalize the creation of the choice list.
     */
    public function __construct()
    {
        $choices = array(
            'improvecode'       => 'I want someone to improve this code.',
            'betterperformance' => 'I want someone to make this code faster.',
            'codinghorror'      => 'This is a sample of Coding Horror.',
            'feedback'          => 'I want feedback on this code.',
            'challenge'         => 'This code is bulletproof, I dare people to make it better.',
        );

        parent::__construct($choices);
    }

}
