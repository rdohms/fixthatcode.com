<?php
namespace FTC\Bundle\AuthBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

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
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options){
        $builder
            ->add('_username')
            ->add('_password', 'password')
            ->add('_remember_me', 'checkbox', array('required' => false));

    }

    /**
     * @return string
     */
    public function getName(){
        return 'caas_user_login';
    }
}

