<?php

namespace FTC\Bundle\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/user/{id}/show", name="xx")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
}
