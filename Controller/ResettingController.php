<?php

/* 
 * To handle resetting of the password using FOS Bundle
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * @author: Ashutosh Rai
 */

namespace BvRoleBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResettingController extends Controller
{
    /**
     * Request reset user password: show form
     */
    public function requestAction(){
        if($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->redirect($this->generateUrl('user_homepage'));
        }
        
        return $this->render('BvRoleBundle:Resetting:request.html.twig');
    }
    
    /**
     * Request reset user password: submit form and send email
     */
    public function sendEmailAction(Request $request)
    {
       $username = $request->request->get('email');
       $user = $this->get('fos_user.user_manager')->findUserByEmail($username);
        
        if (null === $user) {
            return $this->render('BvRoleBundle:Resetting:request.html.twig', array('invalid' => 1));
        }
        
        if (null === $user->getConfirmationToken()) {
            /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
            $tokenGenerator = $this->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }

        $this->get('fos_user.mailer')->sendResettingEmailMessage($user);

        $user->setPasswordRequestedAt(new \DateTime());
        $this->get('fos_user.user_manager')->updateUser($user);

        return new RedirectResponse($this->generateUrl('fos_user_resetting_check_email',
            array('email' => $username)
        ));
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction(Request $request)
    {
        $email = $request->query->get('email');
        if (empty($email)) {
            // the user does not come from the sendEmail action
            return new RedirectResponse($this->generateUrl('fos_user_resetting_request'));
        }
        
        
        $this->get('session')->getFlashBag()->add('success', "An email has been sent to ".$email.". It contains a link you must click to reset your password.");
        return $this->redirect($this->generateUrl('forgot_password'));
                   
        
    }

    /**
     * Get the truncated email displayed when requesting the resetting.
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail(UserInterface $user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }
    
    public function resetAction(Request $request, $token){
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {            
            return $this->redirect($this->generateUrl('user_homepage'));
        }
        
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.resetting.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            $this->get('session')->getFlashBag()->add('success', "The user with confirmation token does not exist for value $token");
            return $this->redirect($this->generateUrl('user_login'));
            //throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
//                $url = $this->generateUrl('user_login');
//                $response = new RedirectResponse($url);
                
                $this->get('session')->getFlashBag()->add('success', "Your password has been reset. Please login with your new password");
                return $this->redirect($this->generateUrl('user_login'));
            }

            $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }
        
        return $this->render('BvRoleBundle:Resetting:reset.html.twig', array(
            'token' => $token,
            'form' => $form->createView(),
        ));
    }
}



