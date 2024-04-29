<?php

namespace app\code;

/**
 * Helper class provides utility methods for debugging and development.
 */
class Helper
{
    /**
     * Dumps the data with formatting for easier readability during debugging.
     * 
     * @param mixed $data The data to be dumped.
     * @return void Outputs the formatted dump of the data.
     */
    public static function dd($data): void
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        exit; // Hinzugefügt, um die Ausführung nach dem Dump zu stoppen.
    }
}
