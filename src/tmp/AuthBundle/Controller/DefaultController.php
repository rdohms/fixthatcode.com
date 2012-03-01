<?php

namespace FTC\Bundles\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {

        $form = $this->createForm(new \FTC\Bundles\AuthBundle\Form\RandomType());

        return array('name' => $name, 'form' => $form->createView());
    }
}
