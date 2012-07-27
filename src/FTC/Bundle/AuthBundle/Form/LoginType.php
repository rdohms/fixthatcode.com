<?php
namespace FTC\Bundle\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Login Type
 *
 * Renders form for login
 *
 * @package FTC
 */
class LoginType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('username')
            ->add('password', 'password')
            ->add('remember_me', 'checkbox', array('required' => false));

    }

    /**
     * @return string
     */
    public function getName(){
        return 'login';
    }
}

