<?php

namespace Realtor\DictionaryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\Branches;
use Realtor\DictionaryBundle\Form\BranchesType;

/**
 * Branches controller.
 *
 * @Route("/branches")
 */
class BranchesController extends Controller
{

    /**
     * Lists all Branches entities.
     *
     * @Route("/", name="branches")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DictionaryBundle:Branches')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Branches entity.
     *
     * @Route("/", name="branches_create")
     * @Method("POST")
     * @Template("DictionaryBundle:Branches:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Branches();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('branches_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Branches entity.
    *
    * @param Branches $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Branches $entity)
    {
        $form = $this->createForm(new BranchesType(), $entity, array(
            'action' => $this->generateUrl('branches_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Branches entity.
     *
     * @Route("/new", name="branches_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Branches();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Branches entity.
     *
     * @Route("/{id}", name="branches_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:Branches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Branches entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Branches entity.
     *
     * @Route("/{id}/edit", name="branches_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:Branches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Branches entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Branches entity.
    *
    * @param Branches $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Branches $entity)
    {
        $form = $this->createForm(new BranchesType(), $entity);

        return $form;
    }
    /**
     * Edits an existing Branches entity.
     *
     * @Route("/update/{id}", name="branches_update")
     * @Method("POST")
     * @Template("DictionaryBundle:Branches:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:Branches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Branches entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('branches_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Branches entity.
     *
     * @Route("/delete/{id}", name="branches_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DictionaryBundle:Branches')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Branches entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('branches'));
    }

    /**
     * Creates a form to delete a Branches entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('branches_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
