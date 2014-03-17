<?php

namespace Realtor\DictionaryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DictionaryBundle:Default:login.html.twig', array('name' => $name));
    }
}
