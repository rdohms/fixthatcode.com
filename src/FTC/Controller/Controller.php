<?php
namespace FTC\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {
        return $this->get('session');
    }
}
