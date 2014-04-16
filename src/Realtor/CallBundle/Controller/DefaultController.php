<?php

namespace Realtor\CallBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @param $callType
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/call/{callType}", requirements={"callType"="\d+"}, defaults={"callType"=0}, name="call_card")
     *
     * @Method({"GET", "POST"})
     */
    public function indexAction($callType)
    {
        $advertisingSource = $this->getDoctrine()->getManager()
            ->getRepository('DictionaryBundle:AdvertisingSource')->findBy(['isActive' => true]);

        return $this->render(
            'CallBundle:Default:index.html.twig',
            [
                'advertisingSource' => $advertisingSource,
                'call_type' => $callType
            ]
        );
    }
}
