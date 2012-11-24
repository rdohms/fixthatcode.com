<?php

namespace FTC\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * User Profile controller
 */
class ProfileController extends Controller
{
    /**
     * @Route("/p/{username}", name="user_profile")
     * @Template()
     */
    public function profileAction($username)
    {
        /** @var $userManager \FOS\UserBundle\Entity\UserManager */
        $userManager = $this->get('fos_user.user_manager');

        /** @var $entryRepo \FTC\Bundle\CodeBundle\Entity\CodeEntryRepository */
        $entryRepo = $this->container->get('doctrine')->getManager()->getRepository('FTCCodeBundle:CodeEntry');

        /** @var $commentsRepo \FTC\Bundle\CodeBundle\Entity\CommentRepository */
        $commentsRepo = $this->container->get('doctrine')->getManager()->getRepository('FTCCodeBundle:Comment');

        $user = $userManager->findUserByUsername($username);

        $comments = $commentsRepo->getUserComments($user);
        $contribs = $comments->filter( function($comment) { return $comment->getSnippet() !== null; } );

        /** @var $paginator \Knp\Component\Pager\Paginator */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entryRepo->getUserEntries($user),
            $this->get('request')->query->get('page', 1),
            5
        );
        $paginationData = $pagination->getPaginationData();

        $stats = new \stdClass();
        $stats->entries       = $paginationData['totalCount'];
        $stats->comments      = $comments->count() - $contribs->count();
        $stats->contributions = $contribs->count();

        return array(
            'user'              => $user,
            'stats'             => $stats,
            'entryPagination' => $pagination
        );
    }
}
