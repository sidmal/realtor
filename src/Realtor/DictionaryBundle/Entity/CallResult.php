<?php

namespace Realtor\DictionaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CallResult
 *
 * @ORM\Table(
 *      name="call_result",
 *      options={
 *          "comment"="справочник результатов разговоров"
 *      }
 * )
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks()
 */
class CallResult
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
     * @ORM\Column(name="outer_id", type="integer")
     */
    private $outerId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_a_active", type="boolean")
     */
    private $isAActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set outerId
     *
     * @param integer $outerId
     * @return CallResult
     */
    public function setOuterId($outerId)
    {
        $this->outerId = $outerId;

        return $this;
    }

    /**
     * Get outerId
     *
     * @return integer 
     */
    public function getOuterId()
    {
        return $this->outerId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CallResult
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
     * Set isAActive
     *
     * @param boolean $isAActive
     * @return CallResult
     */
    public function setIsAActive($isAActive)
    {
        $this->isAActive = $isAActive;

        return $this;
    }

    /**
     * Get isAActive
     *
     * @return boolean 
     */
    public function getIsAActive()
    {
        return $this->isAActive;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateValue()
    {
        $this->createdAt = new \DateTime();
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
}
