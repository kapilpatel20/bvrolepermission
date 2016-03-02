<?php

namespace BvRoleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    public function indexAction()
    { 
        return $this->render('BvRoleBundle:Default:index.html.twig', array('name' => 'alpa'));
    }
}
