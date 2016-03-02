<?php

/* 
 * @author: Ashutosh Rai
 * To Handle user Object
 */

namespace BvRoleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use BvRoleBundle\Form\Type\ChangePasswordFormType;
use BvRoleBundle\Form\Type\ProfileFormType;


class UserController extends Controller
{
    public function indexAction(){
        return $this->render('BvRoleBundle:User:index.html.twig');
    }
    
    public function editAction(Request $rquest){
        
    }
    
    public function changePasswordAction(Request $request){
        
        $user = $this->get('security.context')->getToken()->getUser();
        //echo $user->getId();exit;
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BvRoleBundle:User')->find($user->getId());
        
        $changePasswordForm = $this->createForm(new ChangePasswordFormType(), $user);
        
        if($request->getMethod() == 'POST'){
            $changePasswordForm->handleRequest($request);
            
            if($changePasswordForm->isValid()){
                $userManager = $this->get('fos_user.user_manager');
                $userManager->updateUser($user);
                $this->get('session')->getFlashBag()->add('success','Password updated successfully!');
            }
        }
        
        return $this->render('BvRoleBundle:User:changepassword.html.twig', array(
            'form' => $changePasswordForm->createView()
        ));
    }
    
    public function editProfileAction(Request $request){
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BvRoleBundle:User')->find($user->getId());
        
        $userProfileForm = $this->createForm(new ProfileFormType(), $user);
        if($request->getMethod() == 'POST'){
            $userProfileForm->handleRequest($request);
            
            if($userProfileForm->isValid()){
                $userManager = $this->get('fos_user.user_manager');
                $userManager->updateUser($user);
                $this->get('session')->getFlashBag()->add('success','Profile updated successfully!');
            }
        }
        
        return $this->render('BvRoleBundle:User:editProfile.html.twig',
                array(
                    'form' => $userProfileForm->createView()
                ));
    }
}

