<h1>Data Feed</h1>
<p>A command line tool to parse a local XML file (feed.xml) to a MySQL database or a JSON file.</p>

<h2>Project Overview: From XML to MySQL</h2> 
<img src="images/dataFeed.png" alt="DataFeed Structure">

<h2>Usage</h2>
from XML to MySQL

```bash
php ./data dataFeed -f "feed.xml" -p "database"
```

from XML to JSON
```bash
php ./data dataFeed -f "feed.xml" -p "json"
```

<h2>Extensibility</h2>
Because of the abstraction and the object Product, you can add your own type of input and output storage.
<h3>Example: From XML to JSON</h3>
<img src="images/fromXMLtoJSON.png" alt="fromXMLtoJSON">
<ul>Steps to export into JSON</ul>
<li>Create a directory for the JSON files within the directory outputFiles
<code>mkdir outputFiles/JSON</code></li>
<li>Add 'json' to protected static array $pushToTypes in the file src/app/file/OptionsValidation.php
    in order to pass the validation of the command. 
</li>
<li>Update FileInterface.php and add <code>public function pushToJSON(array $data); </code></li>
<li>Update AbstractFile.php with the new final function pushToJSON</li>

```bash
 final public function pushToJSON($data)
    {
        try {
            $encoders = [new XmlEncoder(), new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new Serializer($normalizers, $encoders);
            $allProducts = [];

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

                $allProducts[] = $importProduct;
            }
            $jsonContent  = $serializer->serialize($allProducts, 'json', ['json_encode_options' => \JSON_PRESERVE_ZERO_FRACTION]);
            $jsonContent = trim($jsonContent, '[]');

            $jsonFileName = $this->getFileName() . '_' . date('Y-m-d_H-i-s');
            $jsonFilePath = __DIR__ . '/../../../outputFiles/JSON/' . $jsonFileName . '.json';

            file_put_contents($jsonFilePath, $jsonContent);
        } catch (Exception | TypeError $e) {
            $logDirectory = dirname(__DIR__, 3) . '/outputFiles/errorLogs';
            $logFile = new ErrorLog($logDirectory);
            $logFile->writeLog('Error: ' . $e->getMessage());

            exit('Error: ' . $e->getMessage());
        }
    }
```
<li>Update the function pushData($data, $storageType) XMLFile.php with the new final function pushToJSON</li>

```bash
public function pushData($data, $storageType)
    {
        if ($storageType == "database") {
            $this->pushToMySQL($data);
        } elseif ($storageType == "json") {
            $this->pushToJSON($data);
        } else {
            throw new \Exception('Failed to push data into ' . $storageType  . ' storage');
        }
    }
```

<h3>Logging Errors</h3>
<p>The errors are logged into outputFiles/errorLogs through the ErrorLog.php class</p>

<h3>Testing</h3>
<p>Most of the testing I did was by running the basic command:</p>

```bash
php ./data dataFeed -f "feed.xml" -p "database"
```
<p>and running the import script directly: </p>

```bash
php src/app/file/xml/import.php --file="test.xml" --pushTo="json"
```