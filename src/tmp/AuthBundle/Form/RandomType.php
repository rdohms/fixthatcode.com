<?php

namespace FTC\Bundles\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Registration Type
 *
 * Rendes a registration form for a new user
 *
 * @package Caas
 * @subpackage UserBundle
 * @category Form
 */
class RandomType extends AbstractType
{

    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options){
        $builder->add('username', 'text') //,array('help' => 'help.registration_username'))
                ->add('email', 'email')
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'validator.password_must_match',
                    'property_path' => false
                ))
                ->add('accept_terms', 'checkbox', array('required' => true, 'property_path' => false))
                ->add('f1', 'textarea')
                ->add('f2', 'integer')
                ->add('f3', 'money')
                ->add('f4', 'number')
                ->add('f5', 'percent')
                ->add('f6', 'search')
                ->add('f7', 'url')
                ->add('f8', 'choice', array(
                        'choices'   => array('morning'   => 'Morning', 'afternoon' => 'Afternoon','evening'   => 'Evening',),
                        'expanded'  => true,
                        'multiple'  => true,
                ))
                ->add('f8a', 'choice', array(
                        'choices'   => array('morning'   => 'Morning', 'afternoon' => 'Afternoon','evening'   => 'Evening',),
                        'expanded'  => false,
                        'multiple'  => false,
                ))
                ->add('f8b', 'choice', array(
                        'choices'   => array('morning'   => 'Morning', 'afternoon' => 'Afternoon','evening'   => 'Evening',),
                        'expanded'  => true,
                        'multiple'  => false,
                ))
                ->add('f8c', 'choice', array(
                        'choices'   => array('morning'   => 'Morning', 'afternoon' => 'Afternoon','evening'   => 'Evening',),
                        'expanded'  => false,
                        'multiple'  => true,
                ))
                ->add('f9', 'file')
                ->add('f11', 'checkbox');
    }

    /**
     * @param array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return $options;
    }

    /**
     * @return string
     */
    public function getName(){
        return 'xform';
    }
}
