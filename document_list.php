<?php

include 'CsvService.php';
include 'DocumentHelper.php';

if ($argc != 4) {
    echo 'Ambiguous number of parameters!';
    exit(1);
}

const STR_PAD_NUMBER = 20;

$documents = [];
$csvRows = [];

$csvService = new CsvService();
$csvService->getCsvRows($documents);
$documents = DocumentHelper::getPartnerAndType($documents);

$returnHeader = array('document_id', 'document_type','partner name', 'total');

foreach ($returnHeader as $h) {
    echo str_pad($h, STR_PAD_NUMBER);
}

echo "\n";
echo str_repeat('=', count($returnHeader) * STR_PAD_NUMBER);
echo "\n";

foreach ($documents as $item) {
    $total = 0;
    $itemCounter = 0;
    do {
        $total += $item['items'][$itemCounter]->unit_price * $item['items'][$itemCounter]->quantity;
        $itemCounter++;
    } while($itemCounter < count($item['items']));

    if ($total > $argv[3]) {

        echo str_pad($item['id'], STR_PAD_NUMBER);
        echo str_pad($item['document_type'], STR_PAD_NUMBER);
        echo str_pad($item['partner']->name, STR_PAD_NUMBER);
        echo str_pad($total, STR_PAD_NUMBER);
        echo "\n";
    }
}