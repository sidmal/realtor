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
                ->findOneBy(array('outerId' => $branch['id_office']));

            if(!$branchEntity){
                $branchEntity = new Branches();

                $branchEntity
                    ->setOuterId($branch['id_office'])
                    ->setName($branch['office_name'])
                    ->setAddress($branch['office_address'])
                    ->setBranchNumber($branch['ext_phone'])
                    ->setCityPhone($branch['office_phone'])
                    ->setOnDutyAgentPhone($branch['duty_agent'])
                    ->setIsActive($branch['maytrans']);
            }
            else{
                $branchEntity
                    ->setName($branch['office_name'])
                    ->setAddress($branch['office_address'])
                    ->setBranchNumber($branch['ext_phone'])
                    ->setCityPhone($branch['office_phone'])
                    ->setOnDutyAgentPhone($branch['duty_agent'])
                    ->setIsActive($branch['maytrans']);
            }

            $this->entityManager->persist($branchEntity);
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

        foreach($branches as $branch){
            $branchEntity = new Branches();

            $branchEntity
                ->setOuterId($branch['id_office'])
                ->setName($branch['office_name'])
                ->setAddress($branch['office_address'])
                ->setBranchNumber($branch['ext_phone'])
                ->setCityPhone($branch['office_phone'])
                ->setOnDutyAgentPhone($branch['duty_agent'])
                ->setIsActive($branch['maytrans']);

            $this->entityManager->persist($branchEntity);
            $this->entityManager->flush();
        }
    }
} 