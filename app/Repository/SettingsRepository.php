<?php

namespace App\Repository;

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class SettingsRepository
{
    public static function get()
    {
        $model = new Settings();
        return $model
            ->where('user_id', Auth::id())
            ->get()[0];
    }

    public static function delete()
    {
        $model = new Settings();
        return $model
            ->where('user_id', Auth::id())
            ->get()[0];
    }
}
