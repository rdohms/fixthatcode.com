<?php

namespace FTC\Bundle\CodeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SnippetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array( 'attr' => array('class' => 'span6') ))
            ->add('code')
        ;
    }

    public function getName()
    {
        return 'ftc_bundle_codebundle_snippettype';
    }
}
