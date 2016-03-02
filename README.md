# bvrolepermission
Role Base permission with fos userbundle

Installation Steps

1) add "friendsofsymfony/user-bundle": "~2.0@dev" in your composer.json file under "require" 

2) composer require kapilpatel20/bvrolepermission
   register bundle in AppKernel.php

    new FOS\UserBundle\FOSUserBundle(),
    new BvRoleBundle\BvRoleBundle()

3) open yourproject/app/config/config.yml, put below code in this file

    fos_user:
    db_driver: orm # other valid values are 'mongodb', 'couchdb' and 'propel'
    firewall_name: main
    user_class: BvRoleBundle\Entity\User
    firewall_name: main
    group:
        group_class: BvRoleBundle\Entity\Group
4) open yourproject/app/config/routing.yml, put below code in this file
    
    bv_role:
    resource: "@BvRoleBundle/Resources/config/routing.yml"
    prefix:   /   

5) open yourproject/app/config/security.yml, update your code with following
    
    security:
    encoders:
        FOS\UserBundle\Model\UserInterface: bcrypt

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: ROLE_ADMIN

    providers:
        fos_userbundle:
            id: fos_user.user_provider.username

    firewalls:
        main:
            pattern: ^/
            form_login:
                provider: fos_userbundle
                #csrf_token_generator: security.csrf.token_manager
                # if you are using Symfony < 2.8, use the following config instead:
                success_handler: login_success_handler
                csrf_provider: form.csrf_provider

            logout:       true
            anonymous:    true

    access_control:
        - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/admin/, role: ROLE_ADMIN }

6) open yourproject/app/config/services.yml, update your code with following

    services:
    fos_user.doctrine_registry:
        alias: doctrine 
        
7) generate tables
    
    php app/console doctrine:schema:update --dump-sql
    php app/console doctrine:schema:update --force

That's it!!!!!!  Now you can check effect of this bundle from your browser. open your browser and 

http://localhost/YOUR-PROJECT-NAME/web/app_dev.php/login 


   
    
    
