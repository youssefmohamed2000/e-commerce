<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::query()->create([
            'email' => 'site@site.com',
            'phone' => '111-5555-6666',
            'phone2' => '666-999-8888',
            'address' => 'مصر-الغربية-المحلة الكبرى',
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54736.457617709886!2d31.130551045768755!3d30.96968402412726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f7bb4d2aa1877b%3A0x6b9caf7bbe867370!2sEl-Mahalla%20El-Kubra%2C%20Al%20Mahalah%20Al%20Kubra%20(Part%202)%2C%20El%20Mahalla%20El%20Kubra%2C%20Gharbia%20Governorate!5e0!3m2!1sen!2seg!4v1662512525987!5m2!1sen!2seg',
            'twitter' => 'https://twitter.com/',
            'facebook' => 'https://www.facebook.com/',
            'pinterest' => 'https://www.pinterest.com/',
            'instagram' => 'https://www.instagram.com/',
            'youtube' => 'https://www.youtube.com/'
        ]);
    }
}
