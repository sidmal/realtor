<?php
/**
 * Created by PhpStorm.
 * User: dmitriysinichkin
 * Date: 29.03.14
 * Time: 20:39
 */

namespace Realtor\DictionaryBundle\Manager;

use Doctrine\ORM\EntityManager;
use Guzzle\Http\Exception\RequestException;
use Realtor\DictionaryBundle\Entity\AdvertisingSource;
use Realtor\DictionaryBundle\Protocol\HttpAbstractTransport;

class AdvertisingSourceManager
{
    private $entityManager;

    private $httpClient;

    private $advertisingSource;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $httpClient = new HttpAbstractTransport();
        $this->httpClient = $httpClient->getClient();
    }

    public function getAdvertisingSource()
    {
        try{
            $response = $this->httpClient->get()->setUrl('http://disp.emls.ru/api/advertising_source')
                ->setHeader('Accept', 'application/json')->send()->json();
        }
        catch(RequestException $e){
            $response = null;
        }

        return $this->advertisingSource = $response;
    }

    public function loadAdvertisingSource()
    {
        $advertisingSource = $this->advertisingSource;
        if(!$advertisingSource){
            $advertisingSource = $this->getAdvertisingSource();
        }

        if(!$advertisingSource){
            return;
        }

        foreach($advertisingSource as $item){
            $advertisingSourceItem = $this->entityManager->getRepository('DictionaryBundle:AdvertisingSource')
                ->findOneBy(['outerId' => $item['id']]);

            if(!$advertisingSourceItem){
                $advertisingSourceItem = new AdvertisingSource();
                $advertisingSourceItem->setOuterId($item['id']);
            }

            $advertisingSourceItem
                ->setName($item['name'])
                ->setIsActive($item['is_active']);

            $this->entityManager->persist($advertisingSourceItem);
            $this->entityManager->flush($advertisingSourceItem);
        }
    }

    public function reLoadAdvertisingSource()
    {
        $advertisingSource = $this->advertisingSource;
        if(!$advertisingSource){
            $advertisingSource = $this->getAdvertisingSource();
        }

        if(!$advertisingSource){
            return;
        }

        $connection = $this->entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeUpdate($platform->getTruncateTableSQL(
            $this->entityManager->getClassMetadata('DictionaryBundle:AdvertisingSource')->getTableName(), true)
        );

        foreach($advertisingSource as $item){
            $advertisingSourceEntity = new AdvertisingSource();

            $advertisingSourceEntity
                ->setOuterId($item['id'])
                ->setName($item['name'])
                ->setIsActive($item['is_active']);

            $this->entityManager->persist($advertisingSourceEntity);
            $this->entityManager->flush($advertisingSourceEntity);
        }
    }
} 