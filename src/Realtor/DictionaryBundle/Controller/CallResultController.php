<?php

namespace Realtor\DictionaryBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\CallResult;

/**
 * CallResult controller.
 *
 * @Route("/call_result_manage")
 */
class CallResultController extends Controller
{

    /**
     * Lists all CallResult entities.
     *
     * @Route("/", name="call_result_manage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DictionaryBundle:CallResult')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a CallResult entity.
     *
     * @Route("/{id}", name="call_result_manage_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:CallResult')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CallResult entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
