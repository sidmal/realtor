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
     *      name="outer_id",
     *      type="integer",
     *      nullable=true,
     *      unique=true,
     *      options={
     *          "comment"="уникальный идентификатор пользователя во внешней системе"
     *      }
     * )
     */
    private $outerId;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(
     *      name="is_active",
     *      type="smallint",
     *      options={
     *          "default"=1,
     *          "comment"="флаг указывающий на то, что пользователь активен в системе"
     *      }
     * )
     */
    private $isActive = 1;

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
     * @var integer
     *
     * @ORM\Column(
     *      name="is_auth_only_app",
     *      type="smallint",
     *      options={
     *          "default"=0,
     *          "comment"="пользователь авторизуется только на стороне приложения, без запроса во внешнюю систему"
     *      }
     * )
     */
    private $isAuthOnlyApp = 0;

    /**
     * к какому офису приписан сотрудник
     *
     * @var \Realtor\DictionaryBundle\Entity\Branches
     *
     * @ORM\ManyToOne(targetEntity="Realtor\DictionaryBundle\Entity\Branches")
     * @ORM\JoinColumn(name="branch_id", referencedColumnName="id")
     */
    private $branch;

    /**
     * id вышестоящего сотрудника
     *
     * @var integer
     *
     * @ORM\Column(name="manager", type="integer", options={"default"=0})
     */
    private $manager = 0;

    /**
     * флаг уволенности
     *
     * @var integer
     *
     * @ORM\Column(name="dismiss", type="smallint", options={"default"=0})
     */
    private $dismiss = 0;

    /**
     * дата увольнения
     *
     * @var \DateTime
     *
     * @ORM\Column(name="dismissDate", type="datetime", nullable=true)
     */
    private $dismissDate;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=85, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="second_name", type="string", length=85, nullable=true)
     */
    private $secondName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=85, nullable=true)
     */
    private $lastName;

    /**
     * если он находится в офисе, то в каком
     *
     * @var \Realtor\DictionaryBundle\Entity\Branches
     *
     * @ORM\ManyToOne(targetEntity="Realtor\DictionaryBundle\Entity\Branches")
     * @ORM\JoinColumn(name="id_office_in", referencedColumnName="id", nullable=true)
     */
    private $idOfficeIn;

    /**
     * флаг того что он находится в офисе
     *
     * @var integer
     *
     * @ORM\Column(name="in_office", type="smallint", options={"default"=0})
     */
    private $inOffice = 0;

    /**
     * номер телефона внутренний, является полем на которое (которые) транслируется звонок
     *
     * @var string
     *
     * @ORM\Column(name="office_phone", type="string", length=128, nullable=true)
     */
    private $officePhone;

    /**
     * то что мы говорили про второй телефон (на мобильном и т.п.)
     *
     * @var string
     *
     * @ORM\Column(name="offices_ip_phone", type="string", length=128, nullable=true)
     */
    private $officesIpPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=128, nullable=true)
     */
    private $phone;

    /**
     * флаг разрешённости перевода звонка на мобильник
     *
     * @var integer
     *
     * @ORM\Column(name="may_trans", type="smallint", options={"default"=0})
     */
    private $mayTrans;

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
     * Set outerId
     *
     * @param integer $outerId
     * @return Users
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
     * @param integer $isActive
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
     * @return integer
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
     * @param integer $isAuthOnlyApp
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
     * @return integer
     */
    public function getIsAuthOnlyApp()
    {
        return $this->isAuthOnlyApp;
    }

    /**
     * Set dismiss
     *
     * @param integer $dismiss
     * @return Users
     */
    public function setDismiss($dismiss)
    {
        $this->dismiss = $dismiss;

        return $this;
    }

    /**
     * Get dismiss
     *
     * @return integer
     */
    public function getDismiss()
    {
        return $this->dismiss;
    }

    /**
     * Set dismissDate
     *
     * @param \DateTime $dismissDate
     * @return Users
     */
    public function setDismissDate($dismissDate)
    {
        $this->dismissDate = $dismissDate;

        return $this;
    }

    /**
     * Get dismissDate
     *
     * @return \DateTime 
     */
    public function getDismissDate()
    {
        return $this->dismissDate;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return Users
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Users
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     * @return Users
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string 
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Users
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set inOffice
     *
     * @param integer $inOffice
     * @return Users
     */
    public function setInOffice($inOffice)
    {
        $this->inOffice = $inOffice;

        return $this;
    }

    /**
     * Get inOffice
     *
     * @return integer
     */
    public function getInOffice()
    {
        return $this->inOffice;
    }

    /**
     * Set officePhone
     *
     * @param string $officePhone
     * @return Users
     */
    public function setOfficePhone($officePhone)
    {
        $this->officePhone = $officePhone;

        return $this;
    }

    /**
     * Get officePhone
     *
     * @return string 
     */
    public function getOfficePhone()
    {
        return $this->officePhone;
    }

    /**
     * Set officesIpPhone
     *
     * @param string $officesIpPhone
     * @return Users
     */
    public function setOfficesIpPhone($officesIpPhone)
    {
        $this->officesIpPhone = $officesIpPhone;

        return $this;
    }

    /**
     * Get officesIpPhone
     *
     * @return string 
     */
    public function getOfficesIpPhone()
    {
        return $this->officesIpPhone;
    }

    /**
     * Set mayTrans
     *
     * @param integer $mayTrans
     * @return Users
     */
    public function setMayTrans($mayTrans)
    {
        $this->mayTrans = $mayTrans;

        return $this;
    }

    /**
     * Get mayTrans
     *
     * @return integer
     */
    public function getMayTrans()
    {
        return $this->mayTrans;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Users
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Users
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
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

    /**
     * Set branch
     *
     * @param \Realtor\DictionaryBundle\Entity\Branches $branch
     * @return Users
     */
    public function setBranch(\Realtor\DictionaryBundle\Entity\Branches $branch = null)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return \Realtor\DictionaryBundle\Entity\Branches 
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Set manager
     *
     * @param integer $manager
     * @return Users
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return integer
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set idOfficeIn
     *
     * @param \Realtor\DictionaryBundle\Entity\Branches $idOfficeIn
     * @return Users
     */
    public function setIdOfficeIn(\Realtor\DictionaryBundle\Entity\Branches $idOfficeIn = null)
    {
        $this->idOfficeIn = $idOfficeIn;

        return $this;
    }

    /**
     * Get idOfficeIn
     *
     * @return \Realtor\DictionaryBundle\Entity\Branches 
     */
    public function getIdOfficeIn()
    {
        return $this->idOfficeIn;
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
     * Set phone
     *
     * @param string $phone
     * @return Users
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
}
