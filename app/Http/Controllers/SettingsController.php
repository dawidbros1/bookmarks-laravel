<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Models\Settings;
use App\Repository\SettingsRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function manage(Request $request)
    {
        $settings = SettingsRepository::get();

        if ($request->isMethod('GET')) {
            return view('settings.manage', ['settings' => $settings]);
        }

        if ($request->isMethod('POST')) {
            $data = [];
            $data['category_public'] = Checkbox::get($request->input('category_public'));
            $data['subcategory_public'] = Checkbox::get($request->input('subcategory_public'));
            $data['page_public'] = Checkbox::get($request->input('page_public'));

            $settings->update($data);

            return redirect()->route('settings.manage')
                ->with('success', 'Dane zostały zaktualizowane');
        }
    }
}
