<?php

namespace BvRoleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DashboardController extends Controller
{
    public function indexAction()
    { 
        $user = $this->getUser();
        
        if (!is_object($user) || !$user instanceof UserInterface) { 
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        return $this->render('BvRoleBundle:Dashboard:index.html.twig');
    }
}
