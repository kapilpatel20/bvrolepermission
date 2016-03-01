<?php

namespace BvRoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissioncategory
 *
 * @ORM\Table(name="permission_category")
 * @ORM\Entity(repositoryClass="BvRoleBundle\Repository\PermissionCategoryRepository")
 */
class PermissionCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    
    
    /**
     * @var integer 
     *
     * @ORM\Column(name="orderno", type="smallint", nullable=true)
     */
    private $orderno;

    /**
     *
     * @ORM\OneToMany(targetEntity="Permission", mappedBy="category")
     */
    protected $permissions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permissions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return PermissionCategory
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
     * Set orderno
     *
     * @param integer $orderno
     *
     * @return PermissionCategory
     */
    public function setOrderno($orderno)
    {
        $this->orderno = $orderno;

        return $this;
    }

    /**
     * Get orderno
     *
     * @return integer
     */
    public function getOrderno()
    {
        return $this->orderno;
    }

    /**
     * Add permission
     *
     * @param \BvRoleBundle\Entity\Permission $permission
     *
     * @return PermissionCategory
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
