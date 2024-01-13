<?php

namespace app\file\xml;
use app\file\AbstractFile;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class XMLFile extends AbstractFile
{
    public function decoding(string $fileName)
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
            $XMLContent = '';
            //log an error
        }

        return $xmlEncoder->decode($XMLContent, 'xml', $context);
    }
}