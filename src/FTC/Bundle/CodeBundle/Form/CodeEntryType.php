<?php
namespace FTC\Bundle\CodeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use FTC\Bundle\CodeBundle\Entity\Choice\CodeEntryTypeChoices;
/**
 * CodeEntry Type
 *
 * Renders form for login
 *
 * @package FTC
 */
class CodeEntryType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options){
        $builder
            ->add('title', null, array(
                'help_block' => 'Give your entry a great title so that people can come help',
                'attr'       => array('class' => 'span6'),
                'label'      => 'Give your entry a title'
            ))
            ->add('description', 'textarea', array(
                'help_block' => 'Give us the juicy details. Be sure to note: what you are trying, why you are
                                 submitting, and any other information which can help giving a "context"',
                'attr' => array('class' => 'span6'),
                'label' => 'Describe your code'
            ))
            ->add('type', 'choice', array(
                'choice_list' => new CodeEntryTypeChoices(),
                'attr'        => array('class' => 'span6'),
                'label'       => "What's your purpose?"
            ))
        ;

    }

    /**
     * @return string
     */
    public function getName(){
        return 'ftc_code_entry';
    }
}

