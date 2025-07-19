<?php
namespace app\modules\export;

use SimpleXMLElement;

final class ExportServices
{
    /**
     * Экспортирует данные в XML формат
     * @param array $data
     * @param string $rootNode
     * @param string $childNode
     * @return string
     */
    public static function ExportXML(array $data, string $rootNode, string $childNode): string {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><$rootNode></$rootNode>");
        foreach ($data as $dto){ 
            $node = $xml->addChild($childNode);
            foreach ((array)$dto as $key => $value) {
                $node->addChild($key, htmlspecialchars($value));
            }
        }
        
        return $xml->asXML();
    }
}
