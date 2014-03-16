<?php

namespace Realtor\DictionaryBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Realtor\DictionaryBundle\Entity\AdvertisingSource;

/**
 * AdvertisingSource controller.
 *
 * @Route("/advertising_source_manage")
 */
class AdvertisingSourceController extends Controller
{

    /**
     * Lists all AdvertisingSource entities.
     *
     * @Route("/", name="advertising_source_manage")
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
     * Finds and displays a AdvertisingSource entity.
     *
     * @Route("/{id}", name="advertising_source_manage_show")
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
            'entity'      => $entity,
        );
    }
}
