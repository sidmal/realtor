<?php

namespace Realtor\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccessCodes
 *
 * @ORM\Table(
 *      name="access_codes",
 *      options={
 *          "comment"="одноразовые коды для авторизации пользователей"
 *      },
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              columns={"code", "active_to_date"}
 *          )
 *      },
 *      indexes={
 *          @ORM\Index(columns={"user_id", "active_to_date"}),
 *      }
 * )
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks()
 */
class AccessCodes
{
    /**
     * новый код
     */
    const STATE_NEW = 0;

    /**
     * код активирован
     */
    const STATE_ACTIVE = 1;

    /**
     * код введен не корректно
     */
    const STATE_FAIL = 2;

    /**
     * код просрочен
     */
    const STATE_EXPIRED = 3;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \Realtor\UserBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Realtor\UserBundle\Entity\Users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *      name="active_to_date",
     *      type="date",
     *      options={
     *          "comment"="код активен на дату"
     *      }
     * )
     */
    private $activeToDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="integer", options={"default"=0})
     */
    private $state;

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
     * Set userId
     *
     * @param \Realtor\UserBundle\Entity\Users $userId
     * @return AccessCodes
     */
    public function setUserId(Users $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Realtor\UserBundle\Entity\Users
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return AccessCodes
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set activeToDate
     *
     * @param \DateTime $activeToDate
     * @return AccessCodes
     */
    public function setActiveToDate($activeToDate)
    {
        $this->activeToDate = $activeToDate;

        return $this;
    }

    /**
     * Get activeToDate
     *
     * @return \DateTime 
     */
    public function getActiveToDate()
    {
        return $this->activeToDate;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return AccessCodes
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
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
