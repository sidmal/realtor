<?php

namespace Realtor\DictionaryBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\BranchPhones;

/**
 * BranchPhones controller.
 *
 * @Route("/branch_phones_manage")
 */
class BranchPhonesController extends Controller
{

    /**
     * Lists all BranchPhones entities.
     *
     * @Route("/", name="branch_phones_manage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DictionaryBundle:BranchPhones')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a BranchPhones entity.
     *
     * @Route("/{id}", name="branch_phones_manage_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DictionaryBundle:BranchPhones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BranchPhones entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
