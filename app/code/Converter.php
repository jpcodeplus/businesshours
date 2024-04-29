<?php

namespace app\code;

use Exception;

/**
 * Converter class provides methods for various types of data conversions.
 */
class Converter
{

    /**
     * Converts a CSV string to an associative array where the first row are keys,
     * and splits strings with "|" into subarrays.
     * 
     * @param string $dataString The CSV data as a string.
     * @param string $delimiter The delimiter used in the CSV data (default is comma).
     * @return array The associative array representation of the CSV data.
     * @throws Exception If the CSV data cannot be processed.
     */
    public static function csvToArray(string $dataString, string $delimiter = ','): array
    {
        $dataArray = [];
        $lines = explode("\n", $dataString);
        $headers = [];

        foreach ($lines as $index => $line) {
            if (!empty($line)) {
                $parsedLine = str_getcsv($line, $delimiter);
                if ($index === 0) {
                    // Setzt die erste Zeile als Kopfzeilen (Schlüssel für die Assoziativarrays)
                    $headers = $parsedLine;
                } else {
                    // Verarbeitet jede Datenzeile
                    $row = [];
                    foreach ($parsedLine as $key => $value) {
                        if (strpos($value, '|') !== false) {
                            // Zerlegt den String in ein Array, wenn '|' gefunden wird
                            $row[$headers[$key]] = explode('|', $value);
                        } else {
                            // Normale Zuweisung, wenn kein '|' vorhanden ist
                            $row[$headers[$key]] = $value;
                        }
                    }
                    $dataArray[] = $row;
                }
            }
        }
        return $dataArray;
    }

    /**
     * Converts JSON string to an array.
     * 
     * @param string $jsonString The JSON string to convert.
     * @return array The array representation of the JSON string.
     * @throws Exception If the JSON cannot be decoded.
     */
    public static function jsonToArray(string $jsonString): array
    {
        $result = json_decode($jsonString, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Fehler beim Parsen des JSON: " . json_last_error_msg());
        }

        return $result;
    }
}
