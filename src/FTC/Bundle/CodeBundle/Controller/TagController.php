<?php

namespace FTC\Bundle\CodeBundle\Controller;

use FTC\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTC\Bundle\CodeBundle\Entity\Snippet;
use FTC\Bundle\CodeBundle\Form\SnippetType;

/**
 * Snippet controller.
 *
 * @Route("/entry/{id}/tag")
 */
class TagController extends Controller
{
    /**
     * Lists all Snippet entities.
     *
     * @Route("/add", name="entry_tag_add")
     */
    public function addAction()
    {
        return \Symfony\Component\HttpFoundation\Response::create();
    }

}
