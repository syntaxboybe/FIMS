<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General Settings
        $generalSettings = [
            [
                'key' => 'site_name',
                'value' => 'Livestock Information Management System',
                'group' => 'general',
                'type' => 'text',
                'label' => 'Site Name',
                'description' => 'The name of your site',
                'order' => 1,
            ],
            [
                'key' => 'site_description',
                'value' => 'A comprehensive system for managing livestock information',
                'group' => 'general',
                'type' => 'textarea',
                'label' => 'Site Description',
                'description' => 'A brief description of your site',
                'order' => 2,
            ],
            [
                'key' => 'contact_email',
                'value' => 'admin@livestockims.com',
                'group' => 'general',
                'type' => 'email',
                'label' => 'Contact Email',
                'description' => 'The main contact email for the site',
                'order' => 3,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1234567890',
                'group' => 'general',
                'type' => 'text',
                'label' => 'Contact Phone',
                'description' => 'The main contact phone for the site',
                'order' => 4,
            ],
        ];

        // Logo and Favicon Settings
        $logoSettings = [
            [
                'key' => 'site_logo',
                'value' => null,
                'group' => 'logo',
                'type' => 'file',
                'label' => 'Site Logo',
                'description' => 'The main logo for your site',
                'order' => 1,
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'group' => 'logo',
                'type' => 'file',
                'label' => 'Site Favicon',
                'description' => 'The favicon for your site',
                'order' => 2,
            ],
        ];

        // System Configuration Settings
        $systemSettings = [
            [
                'key' => 'pagination_limit',
                'value' => '10',
                'group' => 'system',
                'type' => 'number',
                'label' => 'Pagination Limit',
                'description' => 'Number of items to show per page',
                'order' => 1,
            ],
            [
                'key' => 'timezone',
                'value' => 'UTC',
                'group' => 'system',
                'type' => 'select',
                'options' => json_encode([
                    'UTC' => 'UTC',
                    'America/New_York' => 'Eastern Time',
                    'America/Chicago' => 'Central Time',
                    'America/Denver' => 'Mountain Time',
                    'America/Los_Angeles' => 'Pacific Time',
                ]),
                'label' => 'Timezone',
                'description' => 'The default timezone for the site',
                'order' => 2,
            ],
            [
                'key' => 'date_format',
                'value' => 'Y-m-d',
                'group' => 'system',
                'type' => 'select',
                'options' => json_encode([
                    'Y-m-d' => 'YYYY-MM-DD',
                    'm/d/Y' => 'MM/DD/YYYY',
                    'd/m/Y' => 'DD/MM/YYYY',
                    'M j, Y' => 'Month Day, Year',
                ]),
                'label' => 'Date Format',
                'description' => 'The default date format for the site',
                'order' => 3,
            ],
        ];

        // Notification Settings
        $notificationSettings = [
            [
                'key' => 'email_notifications',
                'value' => 'true',
                'group' => 'notification',
                'type' => 'boolean',
                'label' => 'Email Notifications',
                'description' => 'Enable email notifications',
                'order' => 1,
            ],
            [
                'key' => 'sms_notifications',
                'value' => 'false',
                'group' => 'notification',
                'type' => 'boolean',
                'label' => 'SMS Notifications',
                'description' => 'Enable SMS notifications',
                'order' => 2,
            ],
        ];

        // Extensions Settings
        $extensionSettings = [
            [
                'key' => 'enable_api',
                'value' => 'false',
                'group' => 'extension',
                'type' => 'boolean',
                'label' => 'Enable API',
                'description' => 'Enable the API for external access',
                'order' => 1,
            ],
            [
                'key' => 'enable_reports',
                'value' => 'true',
                'group' => 'extension',
                'type' => 'boolean',
                'label' => 'Enable Reports',
                'description' => 'Enable the reporting module',
                'order' => 2,
            ],
        ];

        // Combine all settings
        $allSettings = array_merge(
            $generalSettings,
            $logoSettings,
            $systemSettings,
            $notificationSettings,
            $extensionSettings
        );

        // Insert settings
        foreach ($allSettings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Default settings created successfully.');
    }
}
