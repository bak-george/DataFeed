<?php

namespace app\file;

use app\file\FileInterface;
use app\monitor\ErrorLog;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use entity\Product;
use Exception;
use TypeError;

class AbstractFile implements FileInterface
{
    protected $fileName;
    protected $filePath;

    protected $path;

    final public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    final public function getFileName()
    {
        return $this->fileName;
    }

    final public function setFilePath($fileName)
    {
       $this->path = dirname(__DIR__, 3) . '/inputFiles/' . $fileName;
       if (file_exists($this->path)) {
           return $this;
       } else {
           return false;
           //register error
       }
    }

    final public function getFilePath()
    {
        return $this->path;
    }

    final public function pushToMySQL($data)
    {
        $db = require __DIR__ . '/../../../config/db.php';

        $params = [
            'host'    => $db['host'],
            'dbname'  => $db['dbname'],
            'user'    => $db['user'],
            'port'    => $db['port'],
            'charset' => $db['charset'],
            'driver'  => $db['driver'],
        ];

        $entityManager =  EntityManager::create($params, ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/Entity']));

        try {
            foreach ($data['item'] as $product) {
                $importProduct = (new Product());
                $importProduct->setEntityId($product['entity_id']);
                $importProduct->setCategoryName($product['CategoryName']);
                $importProduct->setSku($product['sku']);
                $importProduct->setName($product['name']);
                $importProduct->setDescription($product['description']);
                $importProduct->setShortdesc($product['shortdesc']);
                $importProduct->setPrice($product['price']);
                $importProduct->setLink($product['link']);
                $importProduct->setImage($product['image']);
                $importProduct->setBrand($product['Brand']);
                $importProduct->setRating($product['Rating']);
                $importProduct->setCaffeineType($product['CaffeineType']);
                $importProduct->setCount($product['Count']);
                $importProduct->setFlavored($product['Flavored']);
                $importProduct->setSeasonal($product['Seasonal']);
                $importProduct->setInstock($product['Instock']);
                $importProduct->setFacebook($product['Facebook']);
                $importProduct->setIsKcup($product['IsKCup']);
                $importProduct->setFileName($this->getFileName());

                $entityManager->persist($importProduct);
            }

            $entityManager->flush();
        } catch (Exception | TypeError $e) {
            $logDirectory = dirname(__DIR__, 3) . '/outputFiles/errorLogs';
            $logFile = new ErrorLog($logDirectory);
            $logFile->writeLog('Error: ' . $e->getMessage());

            exit('Error: ' . $e->getMessage());
        }
    }

    public function decoding($fileName)
    {

    }
}
