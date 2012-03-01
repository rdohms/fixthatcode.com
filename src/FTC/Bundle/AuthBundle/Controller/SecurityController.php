<?php

namespace FTC\Bundle\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTC\Bundle\AuthBundle\Form\LoginType;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {

        $form = $this->createForm(new LoginType());

        return array('form' => $form->createView());
    }
}
