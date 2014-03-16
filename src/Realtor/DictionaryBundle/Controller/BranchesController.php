<?php

namespace Realtor\DictionaryBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\Branches;

/**
 * Branches controller.
 *
 * @Route("/branches_manage")
 */
class BranchesController extends Controller
{

    /**
     * Lists all Branches entities.
     *
     * @Route("/", name="branches_manage")
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
     * Finds and displays a Branches entity.
     *
     * @Route("/{id}", name="branches_manage_show")
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

        return array(
            'entity'      => $entity,
        );
    }
}
