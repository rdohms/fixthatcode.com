<?php

namespace FTC\Bundle\CodeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea', array(
            'label_render' => false,
            'attr' => array('class' => 'span12')
            ))
        ;
    }

    public function getName()
    {
        return 'ftc_bundle_codebundle_commenttype';
    }
}
