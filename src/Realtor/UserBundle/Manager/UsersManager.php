<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 15.04.14
 * Time: 17:01
 */

namespace Realtor\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Realtor\DictionaryBundle\Protocol\HttpAbstractTransport;
use Realtor\UserBundle\Entity\Users;

class UsersManager
{
    private $entityManager;

    private $httpClient;

    private $users;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $httpClient = new HttpAbstractTransport();
        $this->httpClient = $httpClient->getClient();
    }

    public function getUsers()
    {
        try{
            $response = $this->httpClient->get()->setUrl('http://disp.emls.ru/api/employee')
                ->setHeader('Accept', 'application/json')->send()->json();
        }
        catch(RequestException $e){
            $response = null;
        }

        return $this->users = $response;
    }

    public function loadUsers()
    {
        $users = $this->users;
        if(!$users){
            $users = $this->getUsers();
        }

        if(!$users){
            return;
        }

        foreach($users as $user){
            $userEntity = $this->entityManager->getRepository('UserBundle:Users')
                ->findOneBy(['outerId' => $user['id_user']]);

            if(!$userEntity){
                $userEntity = new Users();
                $userEntity->setOuterId($user['id_user']);
            }

            $branch = $this->entityManager->getRepository('DictionaryBundle:Branches')->findOneBy(['outerId' => $user['id_office']]);

            if($branch){
                $userEntity->setBranch($branch);
            }

            if(!empty($user['sys_user_email'])){
                $userEntity->setEmail($user['sys_user_email']);
            }

            if(!empty($user['user_dismiss']) == 1){
                $userEntity
                    ->setDismiss(1)
                    ->setDismissDate(new \DateTime($user['user_dismiss_date']))
                    ->setIsActive(0);
            }

            $userEntity
                ->setFirstName($user['user_name'])
                ->setSecondName($user['user_second_name'])
                ->setLastName($user['user_last_name'])
                ->setFullName($user['user_fio'])
                ->setInOffice((integer)$user['in_office'])
                ->setMayTrans($user['maytrans'])
                ->setLogin($user['login'])
                ->setManager((integer)$user['id_manager'])
                ->setPassword($user['passsha1']);

            if($user['officephone']){
                $userEntity->setOfficePhone($user['officephone']);
            }

            if($user['user_phone']){
                $userEntity->setPhone($user['user_phone']);
            }

            if($user['user_phone']){
                $userEntity->setPhone($user['user_phone']);
            }

            if(!empty($user['id_office_in'])){
                $branch = $this->entityManager->getRepository('DictionaryBundle:Branches')
                    ->findOneBy(['outerId' => $user['id_office']]);

                if($branch){
                    $userEntity->setIdOfficeIn($branch);
                }
            }

            if(!empty($user['officesipphone'])){
                $userEntity->setOfficesIpPhone($user['officesipphone']);
            }

            $role = [];

            if($user['id_role'] == 4){
                $role[] = 'ROLE_MANAGER';
            }
            elseif($user['id_role'] == 2){
                $role[] = 'ROLE_OPERATOR';
            }
            elseif($user['id_role'] == 3){
                $role[] = 'ROLE_AGENT';
            }
            elseif($user['id_role'] == 5){
                $role[] = 'ROLE_OFFICE_PRINCIPAL';
            }
            elseif($user['id_role'] == 1){
                $role[] = 'ROLE_OFFICE_ADMINISTRATOR';
            }
            elseif($user['id_role'] == 6){
                $role[] = 'ROLE_OFFICE_OPERATOR';
            }
            elseif($user['id_role'] == 7){
                $role[] = 'ROLE_FIRM_EMPLOYER';
            }

            $userEntity->setRoles(json_encode($role));

            $this->entityManager->persist($userEntity);
            $this->entityManager->flush($userEntity);
        }
    }

    public function reloadUsers()
    {
        $connection = $this->entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL(
                $this->entityManager->getClassMetadata('UserBundle:Users')->getTableName(), true)
        );

        $users = $this->users;
        if(!$users){
            $users = $this->getUsers();
        }

        if(!$users){
            return;
        }

        foreach($users as $user){
            $userEntity = new Users();
            $userEntity->setOuterId($user['id_user']);

            $branch = $this->entityManager->getRepository('DictionaryBundle:Branches')->findOneBy(['outerId' => $user['id_office']]);

            if($branch){
                $userEntity->setBranch($branch);
            }

            if(!empty($user['sys_user_email'])){
                $userEntity->setEmail($user['sys_user_email']);
            }

            if(!empty($user['user_dismiss']) == 1){
                $userEntity
                    ->setDismiss(1)
                    ->setDismissDate(new \DateTime($user['user_dismiss_date']))
                    ->setIsActive(0);
            }

            $userEntity
                ->setFirstName($user['user_name'])
                ->setSecondName($user['user_second_name'])
                ->setLastName($user['user_last_name'])
                ->setFullName($user['user_fio'])
                ->setInOffice((integer)$user['in_office'])
                ->setMayTrans($user['maytrans'])
                ->setLogin($user['login'])
                ->setManager((integer)$user['id_manager'])
                ->setPassword($user['passsha1']);

            if($user['officephone']){
                $userEntity->setOfficePhone($user['officephone']);
            }

            if($user['user_phone']){
                $userEntity->setPhone($user['user_phone']);
            }

            if($user['user_phone']){
                $userEntity->setPhone($user['user_phone']);
            }

            if(!empty($user['id_office_in'])){
                $branch = $this->entityManager->getRepository('DictionaryBundle:Branches')
                    ->findOneBy(['outerId' => $user['id_office']]);

                if($branch){
                    $userEntity->setIdOfficeIn($branch);
                }
            }

            if(!empty($user['officesipphone'])){
                $userEntity->setOfficesIpPhone($user['officesipphone']);
            }

            $role = [];

            if($user['id_role'] == 4){
                $role[] = 'ROLE_MANAGER';
            }
            elseif($user['id_role'] == 2){
                $role[] = 'ROLE_OPERATOR';
            }
            elseif($user['id_role'] == 3){
                $role[] = 'ROLE_AGENT';
            }
            elseif($user['id_role'] == 5){
                $role[] = 'ROLE_OFFICE_PRINCIPAL';
            }
            elseif($user['id_role'] == 1){
                $role[] = 'ROLE_OFFICE_ADMINISTRATOR';
            }
            elseif($user['id_role'] == 6){
                $role[] = 'ROLE_OFFICE_OPERATOR';
            }
            elseif($user['id_role'] == 7){
                $role[] = 'ROLE_FIRM_EMPLOYER';
            }

            $userEntity->setRoles(json_encode($role));

            $this->entityManager->persist($userEntity);
            $this->entityManager->flush($userEntity);
        }
    }
} 