<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Creates or updates the default settings record with free_shipping_threshold
     */
    public function run(): void
    {
        // Check if settings record exists
        $setting = Setting::first();
        
        if (!$setting) {
            // Create default settings record
            Setting::create([
                'nama_toko' => 'Viviashop',
                'alamat' => 'Jalan Raya No. 123',
                'telepon' => '08123456789',
                'path_logo' => null,
                'free_shipping_threshold' => 50000, // Default Rp50.000
            ]);
            
            $this->command->info('✅ Created default settings record with free_shipping_threshold = Rp50.000');
        } else {
            // Update existing settings to add free_shipping_threshold if it's null
            if (!isset($setting->free_shipping_threshold)) {
                $setting->free_shipping_threshold = 50000;
                $setting->save();
                
                $this->command->info('✅ Updated existing settings record with free_shipping_threshold = Rp50.000');
            } else {
                $this->command->info('ℹ️  Settings record already has free_shipping_threshold = Rp' . number_format($setting->free_shipping_threshold, 0, ',', '.'));
            }
        }
    }
}
