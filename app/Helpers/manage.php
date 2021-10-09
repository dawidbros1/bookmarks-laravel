<?php

namespace App\Helpers;

class Manage
{
    public static function filter($ids, $array)
    {
        $outup['zero'] = [];
        $outup['one'] = [];

        foreach ($ids as $key => $id) {
            if ($array[$key] == 0) array_push($outup['zero'], $id);
            else array_push($outup['one'], $id);
        }

        return $outup;
    }

    public static function updateColumn($zero, $one, $column, $repository)
    {
        $repository->updateColumn($zero, $column, 0);
        $repository->updateColumn($one, $column, 1);
    }
}
