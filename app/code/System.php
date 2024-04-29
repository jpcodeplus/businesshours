<?php

namespace app\code;

use Exception;

/**
 * System class provides utility functions for system operations.
 */

class System
{
    /**
     * Returns a hello world greeting.
     * 
     * @return string A hello world greeting.
     */
    public static function helloWorld(): string
    {
        return 'Hello World by <b>JP/CPM</b>';
    }

    /**
     * Reads the contents of a file and returns it if the file exists.
     * 
     * @param string $filePath The path to the file to be read.
     * @return string The contents of the file.
     * @throws Exception If the file does not exist or cannot be read.
     */
    public static function readFile(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new Exception("Die Datei '$filePath' existiert nicht.");
        }

        $fileContents = file_get_contents($filePath);
        if ($fileContents === false) {
            throw new Exception("Die Datei '$filePath' konnte nicht gelesen werden.");
        }

        return $fileContents;
    }
}
