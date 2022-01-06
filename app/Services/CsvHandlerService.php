<?php

namespace App\Services;

/**
 * Handle CSV file
 */
class CsvHandlerService
{
    private $csv;

    /**
     * @param $csv
     */
    public function __construct($csv)
    {
        $this->csv = $csv;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->createArray();
    }

    /**
     * @return array
     */
    private function createArray(): array
    {
        $out = [];
        $headers = fgetcsv($this->csv);
        while (($data = fgetcsv($this->csv)) !== false) {
            $headCount = 0;
            $row = [];
            foreach ($data as $item) {
                $row[$headers[$headCount]] = $item;
                $headCount++;
            }
            $out[] = $row;
        }
        return $out;
    }
}