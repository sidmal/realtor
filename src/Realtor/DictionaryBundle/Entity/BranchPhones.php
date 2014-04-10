<?php

namespace Realtor\DictionaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BranchPhones
 *
 * @ORM\Table(
 *      name="branch_phones",
 *      options={
 *          "comment"="номера телефонов филиалов"
 *      }
 * )
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks()
 */
class BranchPhones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Realtor\DictionaryBundle\Entity\Branches")
     * @ORM\JoinColumn(name="branch_id", referencedColumnName="id")
     */
    private $branchId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", options={"default"=true})
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->isActive = true;
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
     * Set brancheId
     *
     * @param \Realtor\DictionaryBundle\Entity\Branches $branchId
     * @return BranchPhones
     */
    public function setBrancheId($branchId)
    {
        $this->branchId = $branchId;

        return $this;
    }

    /**
     * Get branchId
     *
     * @return integer 
     */
    public function getBranchId()
    {
        return $this->branchId;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return BranchPhones
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return BranchPhones
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateValue()
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
