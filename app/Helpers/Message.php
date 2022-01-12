<?php

namespace App\Helpers;

class Message
{
    public static function get($id, $type = null)
    {
        $messages = [
            0 => "Brak uprawnień do tego zasobu",
            1 => "Dane zostały zaktualizowane",
            2 => "Strona, do której chciałeś otrzymać dostęp jest prywatna",
            4 => "Wysłany formularz jest nieprawidłowy"
        ];

        $messages['category'] = [
            0 => "Kategoria została utworzona",
            1 => "Kategoria została usunięta",
            2 => "Widoczność kategorii została zmieniona"
        ];

        $messages['subcategory'] = [
            0 => "Podkategoria została utworzona",
            1 => "Podkategoria została usunięta",
            2 => "Widoczność podkategorii została zmieniona"
        ];

        $messages['page'] = [
            0 => "Strona została utworzona",
            1 => "Strona została usunięta",
            2 => "Widoczność strony została zmieniona"
        ];

        if ($type == null) return $messages[$id];
        else return $messages[$type][$id];
    }
}
