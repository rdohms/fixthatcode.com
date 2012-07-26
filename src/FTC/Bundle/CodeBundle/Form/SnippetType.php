<?php

namespace FTC\Bundle\CodeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FTC\Bundle\CodeBundle\Entity\Choice\CodeLanguageChoices;

class SnippetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr'       => array('class' => 'span6', 'placeholder' => 'untitled.php'),
                'label'      => 'Filename',
                'help_block' => 'USe this so people can better grasp you code organizatio',
                'empty_data' => 'untitled.php',
                'required'   => false,
            ))
            ->add('language', 'choice', array(
                'choice_list' => new CodeLanguageChoices(),
                'attr'        => array('class' => 'span6'),
                'label'       => "What language is it written in?",
                'required'    => false,
                'empty_value' => 'Choose a language',
            ))
            ->add('code')
        ;
    }

    public function getName()
    {
        return 'ftc_bundle_codebundle_snippettype';
    }
}
