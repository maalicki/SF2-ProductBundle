<?php

namespace Polcode\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('default/index.html.twig', array('name' => $name));
    }
}
