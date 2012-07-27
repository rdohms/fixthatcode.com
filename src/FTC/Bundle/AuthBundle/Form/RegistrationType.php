<?php
namespace FTC\Bundle\AuthBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('fullname', null, array('label' => "Full Name: "));

        $builder->get('username')->setAttribute('label', 'Username');

        $builder->get('plainPassword')->get('first')->setAttribute('label', 'Password');
        $builder->get('plainPassword')->get('second')->setAttribute('label', 'Confirm Password');


    }

    public function getName()
    {
        return 'ftc_auth_registration';
    }
}
