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
use FTC\Bundle\CodeBundle\Form\ContributeToSnippetType;

/**
 * CodeEntry controller.
 *
 * @Route("/entry")
 */
class CodeEntryController extends Controller
{
    /**
     * Lists all CodeEntry entities.
     *
     * @Route("/", name="entry")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTCCodeBundle:CodeEntry')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a CodeEntry entity.
     *
     * @Route("/{id}/show", name="entry_show")
     * @Template()
     *
     * @param $id
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entry = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

        if (!$entry) {
            throw $this->createNotFoundException('We were unable to find this entry.');
        }

        $commentForm    = $this->createForm(new CommentType());
        $contributeForm = $this->createForm(new ContributeToSnippetType());

        return array(
            'entry'        => $entry,
            'comment_form' => $commentForm->createView(),
            'contrib_form' => $contributeForm->createView(),
        );
    }

    /**
     * Displays a form to create a new CodeEntry entity.
     *
     * @Route("/new", name="entry_new")
     * @Template()
     *
     * @return array
     */
    public function newAction()
    {
        $entry = new CodeEntry();
        $form   = $this->createForm(new CodeEntryType(), $entry);

        return array(
            'entry' => $entry,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new CodeEntry entity.
     *
     * @Route("/create", name="entry_create")
     * @Method("post")
     * @Template("FTCCodeBundle:CodeEntry:new.html.twig")
     *
     * @return mixed
     */
    public function createAction()
    {
        $entry  = new CodeEntry();
        $request = $this->getRequest();
        $form    = $this->createForm(new CodeEntryType(), $entry);
        $form->bindRequest($request);

        if ( ! $form->isValid()) {
            return array(
                'entry' => $entry,
                'form'   => $form->createView()
            );
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($entry);
        $em->flush();

        $this->getSession()->set('current_entry_id', $entry->getId());

        return $this->redirect($this->generateUrl('entry_snippet_new'));


    }

    /**
     * Displays a form to edit an existing CodeEntry entity.
     *
     * @Route("/{id}/edit", name="entry_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CodeEntry entity.');
        }

        $editForm = $this->createForm(new CodeEntryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing CodeEntry entity.
     *
     * @Route("/{id}/update", name="entry_update")
     * @Method("post")
     * @Template("FTCCodeBundle:CodeEntry:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CodeEntry entity.');
        }

        $editForm   = $this->createForm(new CodeEntryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('entry_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a CodeEntry entity.
     *
     * @Route("/{id}/delete", name="entry_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTCCodeBundle:CodeEntry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CodeEntry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('entry'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
