<?php

namespace BvRoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BvRoleBundle\Entity\Group as Group;

/**
 * Permissions
 *
 * @ORM\Table(name="permission")
 * @ORM\Entity(repositoryClass="BvRoleBundle\Repository\PermissionRepository")
 */
class Permission
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;
    
    /**
    * @ORM\Column(type="string", length=255, nullable=false)
    */
    protected $code;

    
    /**
    * @ORM\ManyToMany(targetEntity="Group", mappedBy="permissions")
    *
    */
    protected $groups;

   /**
    * @ORM\ManyToOne(targetEntity="PermissionCategory", inversedBy="permissions")
    * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
    */
    protected $category;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Permission
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Permission
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add group
     *
     * @param \BvRoleBundle\Entity\Group $group
     *
     * @return Permission
     */
    public function addGroup(\BvRoleBundle\Entity\Group $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \BvRoleBundle\Entity\Group $group
     */
    public function removeGroup(\BvRoleBundle\Entity\Group $group)
    {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set category
     *
     * @param \BvRoleBundle\Entity\PermissionCategory $category
     *
     * @return Permission
     */
    public function setCategory(\BvRoleBundle\Entity\PermissionCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BvRoleBundle\Entity\PermissionCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
