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
use FTC\Bundle\CodeBundle\Entity\Snippet;
use FTC\Bundle\CodeBundle\Form\ContributeToSnippetType;

/**
 * CodeEntry Interaction controller.
 *
 * @Route("/entry/{id}")
 */
class CodeEntryInteractionController extends Controller
{

    /**
     * Creates a new CodeEntry entity.
     *
     * @Route("/comment}", name="entry_comment_create")
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
            $this->getFlashBag()->add('error', "Form Error");
            $this->redirect( $this->generateUrl('entry_show', array('id' => $id)) );
        }

        $user = $this->getUser();

        if ($user === null) {
            $this->getFlashBag()->add('error', 'You must be logged in to comment');
            $this->redirect( $this->generateUrl('entry_show', array('id' => $id)) );
        }

        $em = $this->getEntityManager();
        $entry = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

        $comment->setEntry($entry);
        $comment->setAuthor($this->getUser());

        $em->persist($comment);
        $em->flush();

        $this->getFlashBag()->add('success', 'Your comment has been added.');
        return $this->redirect($this->generateUrl('entry_show', array('id' => $id)));


    }

    /**
     * Creates a new snippet with contributed code
     *
     * @Route("/snippet/{snippetId}/contribute", name="entry_snippet_contribute")
     * @Method("POST")
     * @Template()
     *
     * @param int $id
     * @param int $snippetId
     * @return mixed
     */
    public function extendSnippetContributeAction($id, $snippetId)
    {
        $em = $this->getEntityManager();

        $snippet = new Snippet();

        $form    = $this->createForm(new ContributeToSnippetType(), $snippet);
        $form->bindRequest($this->getRequest());

        if ( ! $form->isValid()) {
            //Handle error and return to entry show
            $this->getFlashBag()->add('error', "Form error"); //TODO handle gracefully
            $this->redirect( $this->generateUrl('entry_show', array('id' => $id)) );
        }

        $user = $this->getUser();

        if ($user === null) {
            $this->getFlashBag()->add('error', 'You must be logged in to comment');
            $this->redirect( $this->generateUrl('entry_show', array('id' => $id)) );
        }

        $em = $this->getEntityManager();
        $entry = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

        $comment = new Comment();
        $comment->setAuthor($user);
        $comment->setEntry($entry);
        $comment->setComment($form->get('comment')->getData());
        $comment->setSnippet($snippet);

        $parentSnippet = $em->getRepository('FTCCodeBundle:Snippet')->find($snippetId);

        $snippet->setAuthor($user);
        $snippet->setParent($parentSnippet);
        $snippet->setComment($comment);
        $snippet->setName($parentSnippet->getName());
        $snippet->setLanguage($parentSnippet->getLanguage());

        //Get Diff
        $snippet->setDiff($this->generateDiff($parentSnippet->getCode(), $snippet->getCode()));

        $em->persist($snippet);
        $em->flush();

        $this->getFlashBag()->add('success', 'Your contribution has been added.');
        return $this->redirect($this->generateUrl('entry_show', array('id' => $id)));
    }

    public function generateDiff($parentCode, $currentCode)
    {
        $diff = new \Horde_Text_Diff('auto', array(explode(PHP_EOL, $parentCode), explode(PHP_EOL, $currentCode)));
        $renderer = new \Horde_Text_Diff_Renderer_Unified();

        return $renderer->render($diff);
    }
}
