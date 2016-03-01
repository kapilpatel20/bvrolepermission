<?php

/* 
 * @author: Ashutosh
 * This files is to manage change password form from FOS bundle
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 */

namespace BvRoleBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('current_password', 'password', array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'validation_groups' => array('Default'),
            'constraints' => new UserPassword(),
        ));
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'form.new_password'),
            'second_options' => array('label' => 'form.new_password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BvRoleBundle\Entity\User',
            'intention'  => 'change_password',
            'validation_groups' => 'ChangePassword',
        ));
    }
    
    public function getName() {
        return 'bv_user_changepassword';
    }
}