<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settingsModel = Setting::get();
        $settings = [];
        foreach ($settingsModel as $setting) {
            if ($setting->name === 'cron_expired_interval') {
                $settings[$setting->name] = substr($setting->value, 8, 8);
            }
            else {
                $settings[$setting->name] = $setting->value;
            }
        }

        //$settings = (object) $settings;

        //dd($settings->cron_expired_interval);

        return view('settings.edit', [
            'settings' => (object) $settings
        ]);
    }

    public function update(Request $request, Setting $settings)
    {
        $fieldsWithRules = [
            //'cron_expired_interval' => 'required|regex:/([0-2][0-9]|30) ([0-1][0-9]|2[0-3]):([0-5][0-9])$/'
            'cron_expired_interval' => 'required|date_format:d H:i'
        ];

        $this->validate($request, $fieldsWithRules);

        foreach ($fieldsWithRules as $optionName => $value) {
            $columnsWithValues = [];
            if ($optionName === 'cron_expired_interval') {
                $columnsWithValues = [
                    'name' => $optionName,
                    'value' => "0000-00-" . trim($request->input('cron_expired_interval')) . ":00"
                ];
            }

            if (count($columnsWithValues)) {
                $option = $settings->getOption($optionName);
                if ($option) {
                    $option->update($columnsWithValues);
                } else {
                    Setting::create($columnsWithValues);
                }
            }

        }

        return redirect()->back()->with(['success' => 'Settings were updated.']);
    }
}
