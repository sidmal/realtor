<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 30.03.14
 * Time: 11:10
 */

namespace Realtor\DictionaryBundle\Manager;

use Doctrine\ORM\EntityManager;
use Realtor\DictionaryBundle\Entity\Branches;
use Realtor\DictionaryBundle\Entity\BranchPhones;
use Realtor\DictionaryBundle\Protocol\HttpAbstractTransport;

class BranchesManager
{
    private $entityManager;

    private $httpClient;

    private $branches;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $httpClient = new HttpAbstractTransport();
        $this->httpClient = $httpClient->getClient();
    }

    public function getBranches()
    {
        try{
            $response = $this->httpClient->get()->setUrl('http://disp.emls.ru/api/branches')
                ->setHeader('Accept', 'application/json')->send()->json();
        }
        catch(RequestException $e){
            $response = null;
        }

        return $this->branches = $response;
    }

    public function loadBranches()
    {
        $branches = $this->branches;
        if(!$branches){
            $branches = $this->getBranches();
        }

        if(!$branches){
            return;
        }

        foreach($branches as $branch){
            $branchEntity = $this->entityManager->getRepository('DictionaryBundle:Branches')
                ->findOneBy(['outerId' => $branch['id_office']]);

            if(!$branchEntity){
                $branchEntity = new Branches();

                $branchEntity
                    ->setOuterId($branch['id_office'])
                    ->setName($branch['office_name'])
                    ->setAddress($branch['office_address']);
            }
            else{
                $branchEntity
                    ->setName($branch['office_name'])
                    ->setAddress($branch['office_address']);
            }

            $this->entityManager->persist($branchEntity);

            $branchPhone = $this->entityManager->getRepository('DictionaryBundle:BranchPhones')
                ->findBy(['branchId' => $branchEntity->getId()]);

            if($branchPhone){
                foreach($branchPhone as $item){
                    $this->entityManager->remove($item);
                }
            }

            if(is_array($branch['office_phone'])){
                foreach($branch['office_phone'] as $phone){
                    $branchPhone = new BranchPhones();
                    $branchPhone->setPhone($phone)->setBrancheId($branchEntity);

                    $this->entityManager->persist($branchPhone);
                }
            }
            else{
                $branchPhone = new BranchPhones();
                $branchPhone->setPhone($branch['office_phone'])->setBrancheId($branchEntity);
                $this->entityManager->persist($branchPhone);
            }

            $this->entityManager->flush();
        }
    }

    public function reLoadBranches()
    {
        $branches = $this->branches;
        if(!$branches){
            $branches = $this->getBranches();
        }

        if(!$branches){
            return;
        }

        $connection = $this->entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL(
                $this->entityManager->getClassMetadata('DictionaryBundle:Branches')->getTableName(), true)
        );
        $connection->executeUpdate($platform->getTruncateTableSQL(
                $this->entityManager->getClassMetadata('DictionaryBundle:BranchPhones')->getTableName(), true)
        );

        foreach($branches as $branch){
            $branchEntity = new Branches();

            $branchEntity
                ->setOuterId($branch['id_office'])
                ->setName($branch['office_name'])
                ->setAddress($branch['office_address']);

            $this->entityManager->persist($branchEntity);

            if(is_array($branch['office_phone'])){
                foreach($branch['office_phone'] as $phone){
                    $branchPhone = new BranchPhones();
                    $branchPhone->setPhone($phone)->setBrancheId($branchEntity);

                    $this->entityManager->persist($branchPhone);
                }
            }
            else{
                $branchPhone = new BranchPhones();
                $branchPhone->setPhone($branch['office_phone'])->setBrancheId($branchEntity);

                $this->entityManager->persist($branchPhone);
            }

            $this->entityManager->flush();
        }
    }
} 