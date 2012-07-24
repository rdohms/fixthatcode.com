<?php

namespace FTC\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTC\Bundle\CodeBundle\Entity\Choice\CodeEntryTypeChoices;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $categories = new CodeEntryTypeChoices();

        $entryService = $this->get('ftc_code.entry');
        $latest = $entryService->getLatest(5);

        /** @var $userRepo \FTC\Bundle\AuthBundle\Entity\UserRepository */
        $userRepo = $this->getDoctrine()->getManager()->getRepository('FTCAuthBundle:User');
        $users    = $userRepo->getLatest(20);

        return array(
            'users'      => $users,
            'entries'    => $latest,
            'categories' => $categories,
        );
    }

    /**
     * @Route("/about", name="about")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }
}
