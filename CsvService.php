<?php

class CsvService {
    public function getCsvRows(&$documents): void {
        $currentRow = 1;
        if (($handle = fopen('document_list.csv', 'r')) !== false) {
            while (($csvRow = fgetcsv($handle, null, ';')) !== false) {
                if ($currentRow == 1) {
                    $csvRows = $csvRow;
                } else {
                    $results = [];
                    for ($i = 0; $i < count($csvRows); $i++) {
                        $jsonDecodedRow = json_decode($csvRow[$i]);
                        if (json_last_error() == 0) {
                            $results[$csvRows[$i]] = $jsonDecodedRow;
                        } else {
                            $results[$csvRows[$i]] = $csvRow[$i];

                        }
                    }
                    $documents[] = $results;
                }
                $currentRow++;
            }
            fclose($handle);
        }
    }
}