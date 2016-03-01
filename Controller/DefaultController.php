<?php

namespace BvRoleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    { 
        return $this->render('BvRoleBundle:Default:index.html.twig', array('name' => 'alpa'));
    }
}
