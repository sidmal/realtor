<?php

namespace Realtor\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(
 *      name="users",
 *      options={
 *          "comment"="справочник пользователей системы"
 *      }
 * )
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Users
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
     * @ORM\Column(
     *      name="crm_id",
     *      type="integer",
     *      nullable=true,
     *      unique=true,
     *      options={
     *          "comment"="уникальный идентификатор пользователя во внешней системе"
     *      }
     * )
     */
    private $crmId;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, unique=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * дата последней авторизации пользователя в системе
     *
     * @var \DateTime
     *
     * @ORM\Column(
     *      name="last_login",
     *      type="datetime",
     *      nullable=true,
     *      options={
     *          "comment"="дата последней авторизации пользователя в системе"
     *      }
     * )
     */
    private $lastLogin;

    /**
     * @var boolean
     *
     * @ORM\Column(
     *      name="is_active",
     *      type="boolean",
     *      options={
     *          "default"=true,
     *          "comment"="флаг указывающий на то, что пользователь активен в системе"
     *      }
     * )
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(
     *      name="roles",
     *      type="text",
     *      options={
     *          "default"="[]",
     *          "comment"="json массив ролей пользователя"
     *      }
     * )
     */
    private $roles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(
     *      name="expired_at",
     *      type="datetime",
     *      nullable=true,
     *      options={
     *          "comment"="пользователю разрешен вход в систему до даты"
     *      }
     * )
     */
    private $expiredAt;

    /**
     * @var boolean
     *
     * @ORM\Column(
     *      name="is_auth_only_app",
     *      type="boolean",
     *      options={
     *          "default"=false,
     *          "comment"="пользователь авторизуется только на стороне приложения, без запроса во внешнюю систему"
     *      }
     * )
     */
    private $isAuthOnlyApp;

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
     * Set crmId
     *
     * @param integer $crmId
     * @return Users
     */
    public function setCrmId($crmId)
    {
        $this->crmId = $crmId;

        return $this;
    }

    /**
     * Get crmId
     *
     * @return integer 
     */
    public function getCrmId()
    {
        return $this->crmId;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return Users
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Users
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
     * Set roles
     *
     * @param string $roles
     * @return Users
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set expiredAt
     *
     * @param \DateTime $expiredAt
     * @return Users
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    /**
     * Get expiredAt
     *
     * @return \DateTime 
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * Set isAuthOnlyApp
     *
     * @param boolean $isAuthOnlyApp
     * @return Users
     */
    public function setIsAuthOnlyApp($isAuthOnlyApp)
    {
        $this->isAuthOnlyApp = $isAuthOnlyApp;

        return $this;
    }

    /**
     * Get isAuthOnlyApp
     *
     * @return boolean 
     */
    public function getIsAuthOnlyApp()
    {
        return $this->isAuthOnlyApp;
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
