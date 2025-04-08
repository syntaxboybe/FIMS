<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('order')->get();

        // Group settings by their group
        $groupedSettings = $settings->groupBy('group');

        return view('admin.settings.index', compact('groupedSettings'));
    }

    /**
     * Display the settings for a specific group.
     *
     * @param string $group
     * @return \Illuminate\Http\Response
     */
    public function group($group)
    {
        $settings = Setting::where('group', $group)
            ->orderBy('order')
            ->get();

        return view('admin.settings.' . $group, compact('settings', 'group'));
    }

    /**
     * Update the settings.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group)
    {
        $settings = Setting::where('group', $group)->get();

        foreach ($settings as $setting) {
            if ($setting->type === 'file' && $request->hasFile($setting->key)) {
                // Handle file upload
                $file = $request->file($setting->key);
                $path = $file->store('settings', 'public');

                // Delete old file if exists
                if ($setting->value) {
                    Storage::disk('public')->delete($setting->value);
                }

                $setting->value = $path;
                $setting->save();
            } elseif ($setting->type === 'boolean') {
                // Handle boolean values
                $setting->value = $request->has($setting->key) ? 'true' : 'false';
                $setting->save();
            } elseif ($request->has($setting->key)) {
                // Handle other types
                $setting->value = $request->input($setting->key);
                $setting->save();
            }
        }

        return redirect()->route('admin.settings.group', $group)
            ->with('success', ucfirst($group) . ' settings updated successfully');
    }
}
