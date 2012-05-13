<?php

namespace FTC\Bundle\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FTC\Bundle\CodeBundle\Entity\Vote;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/vote")
 */
class VoteController extends BaseController
{
    /**
     * @Route("/{vote}/comment/{id}")
     * @Template()
     *
     * @param string $vote
     * @param int $id
     *
     * @return Response
     */
    public function commentAction($vote, $id)
    {
        try {

            $commentRepository = $this->getDoctrine()->getManager()->getRepository('FTCCodeBundle:Comment');
            $comment = $commentRepository->find($id);

            if ($comment === null) {
                return $this->getResponder()->get404Response();
            }

            $vote = new Vote();
            $vote->setComment($comment);
            $vote->setValue( ($vote == 'up')? 1:-1 );
            $vote->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vote);

            $content = array('vote' => $vote);
            return $this->getResponder()->getSuccessResponse($content);

        } catch (\Exception $e) {

            $context = array(
                'message'   => $e->getMessage(),
                'exception' => $e,
                'projectId' => $id
            );

            $this->get('logger')->err('Error registering vote.', $context);

            return $this->getResponder()->get500Response();
        }
    }
}
