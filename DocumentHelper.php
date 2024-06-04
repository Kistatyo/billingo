<?php

class DocumentHelper {
    public static function getPartnerAndType(array $documents): array {
        return array_filter($documents, function ($item) {
            global $argv;
        
            $partnerDetails = (array)$item['partner'];
            $partner = (!empty($partnerDetails['id']) && $partnerDetails['id'] == $argv[2]);
            $type = $item['document_type'] == $argv[1];
        
            return $partner && $type;
        });
    }
}