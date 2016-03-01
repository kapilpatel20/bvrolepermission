<?php

namespace BvRoleBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BvRoleBundle\Repository\GroupRepository")
 * @ORM\Table(name="group_master")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
     
     /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     *
     */
     protected $users;
     
     
     /**
     * @ORM\ManyToMany(targetEntity="Permission", inversedBy="groups")
     * @ORM\JoinTable(name="group_permission")
     **/
     private $permissions;
     
     /**
     * Constructor
     */
     public function __construct()
     {
       $this->roles = array('ROLE_ADMIN');  
       $this->users = new \Doctrine\Common\Collections\ArrayCollection();
       $this->permissions = new \Doctrine\Common\Collections\ArrayCollection();
     }
     


    /**
     * Add user
     *
     * @param \BvRoleBundle\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\BvRoleBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \BvRoleBundle\Entity\User $user
     */
    public function removeUser(\BvRoleBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function getGroupPermissionArr() {
        $permissionArr = array();
        
        foreach($this->permissions as $permission) {
            $permissionArr[$permission->getCode()] = $permission->getCode();
        }
        
        return $permissionArr;
    }

    /**
     * Add permission
     *
     * @param \BvRoleBundle\Entity\Permission $permission
     *
     * @return Group
     */
    public function addPermission(\BvRoleBundle\Entity\Permission $permission)
    {
        $this->permissions[] = $permission;

        return $this;
    }

    /**
     * Remove permission
     *
     * @param \BvRoleBundle\Entity\Permission $permission
     */
    public function removePermission(\BvRoleBundle\Entity\Permission $permission)
    {
        $this->permissions->removeElement($permission);
    }

    /**
     * Get permissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}
