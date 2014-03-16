<?php

namespace Realtor\DictionaryBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\Reason;

/**
 * Reason controller.
 *
 * @Route("/reason_manage")
 */
class ReasonController extends Controller
{

    /**
     * Lists all Reason entities.
     *
     * @Route("/", name="reason_manage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DictionaryBundle:Reason')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Reason entity.
     *
     * @Route("/{id}", name="reason_manage_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:Reason')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reason entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
