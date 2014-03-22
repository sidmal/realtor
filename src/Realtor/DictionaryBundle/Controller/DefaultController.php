<?php

namespace Realtor\DictionaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package Realtor\DictionaryBundle\Controller
 *
 * @Route("/login")
 */
class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="login")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        return $this->render('DictionaryBundle:Default:login.html.twig');
    }
}
