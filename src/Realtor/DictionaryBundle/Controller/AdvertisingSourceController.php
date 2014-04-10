<?php

namespace Realtor\DictionaryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\AdvertisingSource;
use Realtor\DictionaryBundle\Form\AdvertisingSourceType;

/**
 * AdvertisingSource controller.
 *
 * @Route("/advertising_source")
 */
class AdvertisingSourceController extends Controller
{

    /**
     * Lists all AdvertisingSource entities.
     *
     * @Route("/", name="advertising_source")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DictionaryBundle:AdvertisingSource')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AdvertisingSource entity.
     *
     * @Route("/", name="advertising_source_create")
     * @Method("POST")
     * @Template("DictionaryBundle:AdvertisingSource:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AdvertisingSource();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('advertising_source_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a AdvertisingSource entity.
    *
    * @param AdvertisingSource $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AdvertisingSource $entity)
    {
        $form = $this->createForm(new AdvertisingSourceType(), $entity);

        return $form;
    }

    /**
     * Displays a form to create a new AdvertisingSource entity.
     *
     * @Route("/new", name="advertising_source_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AdvertisingSource();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AdvertisingSource entity.
     *
     * @Route("/{id}", name="advertising_source_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:AdvertisingSource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdvertisingSource entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing AdvertisingSource entity.
     *
     * @Route("/{id}/edit", name="advertising_source_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:AdvertisingSource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdvertisingSource entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity
        );
    }

    /**
    * Creates a form to edit a AdvertisingSource entity.
    *
    * @param AdvertisingSource $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AdvertisingSource $entity)
    {
        $form = $this->createForm(new AdvertisingSourceType(), $entity);

        return $form;
    }
    /**
     * Edits an existing AdvertisingSource entity.
     *
     * @Route("/update/{id}", name="advertising_source_update")
     * @Method("POST")
     * @Template("DictionaryBundle:AdvertisingSource:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:AdvertisingSource')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdvertisingSource entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('advertising_source_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a AdvertisingSource entity.
     *
     * @Route("/delete/{id}", name="advertising_source_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DictionaryBundle:AdvertisingSource')->find($id);

        if(!$entity){
            throw $this->createNotFoundException('Unable to find AdvertisingSource entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('advertising_source'));
    }
}
