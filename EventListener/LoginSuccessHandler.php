<?php

namespace BvRoleBundle\EventListener;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Cookie;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $security;
    protected $session;
    protected $container;
    protected $entityManager;

    public function __construct(Router $router, SecurityContext $security, Session $session, Container $container, $entityManager) {
        $this->router = $router;
        $this->security = $security;
        $this->session = $session;
        $this->container = $container;
        $this->entityManager = $entityManager;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
         
       
        $user = $this->security->getToken()->getUser();
        
        if ($user->hasRole('ROLE_SUPER_ADMIN') || $user->hasRole('ROLE_ADMIN') ) {
            
            $admin = $this->security->getToken()->getUser();
            $group = $admin->getGroupObject();
            $this->session->set('permissions', $group->getGroupPermissionArr());
            
            $response = new RedirectResponse($this->router->generate('dashoboard'));
         }else {
             
             //REMOVE SESSION AND REDIRCT TO LOGIN PAGE
             $this->security->setToken(null);
             $this->container->get('request')->getSession()->invalidate();
            
             $this->session->getFlashBag()->add('failure', 'You are not authrize to login.');
             $response = new RedirectResponse($this->router->generate('user_login'));
        }  
        return $response;
        
    }

}
