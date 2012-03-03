<?php

namespace FTC\Bundle\CodeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SnippetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr'       => array('class' => 'span6', 'placeholder' => 'untitled.php'),
                'label'      => 'Filename',
                'help_block' => 'We will use this to offer language compatible highlighting below and for organization',
                'empty_data' => 'untitled.php',
                'required'   => false,
            ))
            ->add('code')
        ;
    }

    public function getName()
    {
        return 'ftc_bundle_codebundle_snippettype';
    }
}
