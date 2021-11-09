<?php

namespace App\Helpers;

class Message
{
    public static function get($id, $type = null)
    {
        $messages = [];
        $page = [];
        $category = [];
        $subcategory = [];

        // KOMUNIKATY OGÓLNE
        $messages[0] = "Zawartość do której chcesz otrzymać dostęp nie istnieje";
        $messages[1] = "Dane zostały zaktualizowane";
        $messages[2] = "Brak uprawnień do tego zasobu";

        // KOMUNIKATY DLA KATEGORII
        $category[0] = "Kategoria została utworzona";
        $category[1] = "Kategoria została usunięta";
        $category[2] = "Widoczność kategorii została zmieniona";

        // KOMUNIKATY DLA PODKATEGORII
        $subcategory[0] = "Podkategoria została utworzona";
        $subcategory[1] = "Podkategoria została usunięta";
        $subcategory[2] = "Widoczność podkategorii została zmieniona";

        // KOMUNIKATY DLA STRON
        $page[0] = "Strona została utworzona";
        $page[1] = "Strona została usunięta";
        $page[2] = "Widoczność strony została zmieniona";

        if ($type == null) return $messages[$id];
        else if ($type == "category") return $category[$id];
        else if ($type == "subcategory") return $subcategory[$id];
        else if ($type == "page") return $page[$id];
    }
}
