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
     * @Route("/{vote}/comment/{id}", name="api_vote_comment")
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

            /** @var $voteRepository \FTC\Bundle\CodeBundle\Entity\VoteRepository */
            $voteRepository = $this->getDoctrine()->getManager()->getRepository('FTCCodeBundle:Vote');
            $commentVote = $voteRepository->getExistingVote($comment, $this->getUser());

            if ($commentVote == null) {

                $commentVote = new Vote();
                $commentVote->setComment($comment);
                $commentVote->setUser($this->getUser());

            }

            $commentVote->setValue( ($vote == 'up')? 1:-1 );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentVote);
            $entityManager->flush();

            $entityManager->refresh($comment);

            $content = array('vote' => $commentVote, 'totals' => (array) $comment->getVoteSum());
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
