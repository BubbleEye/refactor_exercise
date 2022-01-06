<?php

namespace App\Services;

use Exception;

/**
 * Creat array from JSON
 */
class JsonReaderService
{

    /**
     * @param $json
     * @return array
     * @throws Exception
     */
    public static function load($json): array
    {
        $array = json_decode($json, true);
        if (empty($array)) {
            throw new Exception('Invalid json!');
        }
        return $array;
    }
}