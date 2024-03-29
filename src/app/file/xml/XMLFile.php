<?php

namespace app\file\xml;
use App\app\file\AbstractFile;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class XMLFile extends AbstractFile
{
    public function decoding($fileName)
    {
        $this->setFileName($fileName);
        $this->setFilePath($fileName);

        $xmlEncoder = new XmlEncoder();

        $context = [
            XmlEncoder::DECODER_IGNORED_NODE_TYPES => [\XML_PI_NODE, \XML_COMMENT_NODE],
            'xml_format_output' => true,
        ];

        $XMLContent = file_get_contents($this->getFilePath());

        return $xmlEncoder->decode($XMLContent, 'xml', $context);
    }

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
}
