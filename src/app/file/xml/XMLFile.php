<?php

namespace app\file\xml;
use app\file\AbstractFile;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use function Symfony\Component\String\s;

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

        if (is_readable($this->getFilePath())) {
            $XMLContent = file_get_contents($this->getFilePath());
        } else {
            throw new \Exception('XML file is not readable');
        }

        return $xmlEncoder->decode($XMLContent, 'xml', $context);
    }

    public function pushData($data, $storageType)
    {
        if ($storageType == "database") {
            $this->pushToMySQL($data);

            return true;
        } else {
            throw new \Exception('Failed to push data into storage');
        }
    }

}
