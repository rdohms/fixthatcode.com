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
 * @Route("/entry/snippet")
 */
class SnippetController extends Controller
{
    /**
     * Lists all Snippet entities.
     *
     * @Route("/", name="entry_snippet")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('FTCCodeBundle:Snippet')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Snippet entity.
     *
     * @Route("/{id}/show", name="entry_snippet_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTCCodeBundle:Snippet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Snippet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Snippet entity.
     *
     * @Route("/new", name="entry_snippet_new")
     * @Template()
     */
    public function newAction()
    {
        $snippet = new Snippet();
        $form   = $this->createForm(new SnippetType(), $snippet);

        $em = $this->getDoctrine()->getEntityManager();
        $entry = $em->find('FTCCodeBundle:CodeEntry', $this->getSession()->get('current_entry_id'));

        return array(
            'snippet' => $snippet,
            'form'    => $form->createView(),
            'entry'   => $entry
        );
    }

    /**
     * Creates a new Snippet entity.
     *
     * @Route("/create", name="entry_snippet_create")
     * @Method("post")
     * @Template("FTCCodeBundle:Snippet:new.html.twig")
     */
    public function createAction()
    {
        $snippet  = new Snippet();
        $request = $this->getRequest();
        $form    = $this->createForm(new SnippetType(), $snippet);
        $form->bindRequest($request);

        if ( ! $form->isValid()) {
            return array(
                'snippet' => $snippet,
                'form'   => $form->createView()
            );
        }

        $em = $this->getDoctrine()->getEntityManager();

        $entry = $em->find('FTCCodeBundle:CodeEntry', $this->getSession()->get('current_entry_id'));

        if ($entry === null) {
            throw new \UnexpectedValueException("Corresponding Entry was not found.");
        }

        $snippet->setEntry($entry);

        $user = $this->getUser();
        $snippet->setAuthor($user);

        $em->persist($snippet);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'The snippet ' . $snippet->getName() . ' was added successfully');

        if ($request->get('done') !== null ){
            return $this->redirect($this->generateUrl('entry_show', array('id' => $entry->getId())));
        }

        return $this->redirect($this->generateUrl('entry_snippet_new'));
    }

    /**
     * Displays a form to edit an existing Snippet entity.
     *
     * @Route("/{id}/edit", name="entry_snippet_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTCCodeBundle:Snippet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Snippet entity.');
        }

        $editForm = $this->createForm(new SnippetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Snippet entity.
     *
     * @Route("/{id}/update", name="entry_snippet_update")
     * @Method("post")
     * @Template("FTCCodeBundle:Snippet:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('FTCCodeBundle:Snippet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Snippet entity.');
        }

        $editForm   = $this->createForm(new SnippetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('entry_snippet_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Snippet entity.
     *
     * @Route("/{id}/delete", name="entry_snippet_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('FTCCodeBundle:Snippet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Snippet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('entry_snippet'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
