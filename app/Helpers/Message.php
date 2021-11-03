<?php

namespace App\Helpers;

class Message
{
    public static function get($id)
    {
        $messages = [];
        $messages[0] = "Zawartość do której chcesz otrzymać dostęp nie istnieje";
        $messages[1] = "Dane zostały zaktualizowane";
        $messages[2] = "Brak uprawnień do tego zasobu";
        $messages[3] = "Element został dodany";

        return $messages[$id];
    }
}
