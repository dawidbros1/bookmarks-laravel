<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Models\Settings;
use App\Repository\SettingsRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function manage()
    {
        $settings = SettingsRepository::get();
        return view('settings.manage', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        // Zawsze pobieramy dane aktualnego użytkownika
        $settings = SettingsRepository::get();

        $data = [];
        $data['category_public'] = Checkbox::get($request->input('category_public'));
        $data['subcategory_public'] = Checkbox::get($request->input('subcategory_public'));
        $data['page_public'] = Checkbox::get($request->input('page_public'));
        $data['page_open_in_new_window'] = Checkbox::get($request->input('page_open_in_new_window'));

        $settings->update($data);

        return redirect()->route('manage.settings')
            ->with('success', 'Dane zostały zaktualizowane');
    }
}
