<?php

namespace FTC\Bundle\CodeBundle\Controller;

use FTC\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FTC\Bundle\CodeBundle\Entity\CodeEntry;
use FTC\Bundle\CodeBundle\Form\CodeEntryType;
use FTC\Bundle\CodeBundle\Entity\Comment;
use FTC\Bundle\CodeBundle\Form\CommentType;

/**
 * CodeEntry Interaction controller.
 *
 * @Route("/entry")
 */
class CodeEntryInteractionController extends Controller
{

    /**
     * Creates a new CodeEntry entity.
     *
     * @Route("/{id}/comment}", name="entry_comment_create")
     * @Method("post")
     * @Template()
     *
     * @param $id
     * @return mixed
     */
    public function commentCreateAction($id)
    {
        $request = $this->getRequest();

        $comment = new Comment();

        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ( ! $form->isValid()) {
            //Handle error and return to entry show
            $this->getFlashBag()->set('error', "Form Error");
            $this->redirect( $this->generateUrl('entry_show', array('id' => $id)) );
        }

        $user = $this->getUser();

        if ($user === null) {
            $this->getFlashBag()->set('error', 'You must be logged in to comment');
            $this->redirect( $this->generateUrl('entry_show', array('id' => $id)) );
        }

        $em = $this->getEntityManager();
        $entry = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

        $comment->setEntry($entry);
        $comment->setAuthor($this->getUser());

        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('entry_show', array('id' => $id)));


    }

}
