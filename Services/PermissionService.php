<?php
namespace BvRoleBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class PermissionService {

    private $session;

    public function __construct(Session $session) {
        $this->session = $session;
    }
    
    /*
     * $return  is used to check page is comming from controller or from twig
     * if from twig just return value else through exception 
     */
    public function checkPermission($permissionkey, $return = 'Yes' ){
        $permitted_actions = $this->session->get('permissions');
        if($permitted_actions != null && in_array($permissionkey, $permitted_actions)){
            return true; 
        }else{
            if($return != 'Yes' ){
                throw new AccessDeniedException();
            }else{
                return false;
            }
            
        }
    }
}

