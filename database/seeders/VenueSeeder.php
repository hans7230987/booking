<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venue;

class VenueSeeder extends Seeder
{
    public function run()
    {
        Venue::create([
            'name' => '陽光羽球館',
            'address' => '台北市中山區民生東路100號',
            'description' => '專業羽球館，提供多個羽球場地。',
            'capacity' => 100
        ]);

        Venue::create([
            'name' => '快樂籃球館',
            'address' => '新北市板橋區文化路200號',
            'description' => '室內籃球場，適合團隊比賽和練習。',
            'capacity' => 50
        ]);

        Venue::create([
            'name' => '星光桌球館',
            'address' => '台中市西屯區文心路300號',
            'description' => '桌球愛好者聚集地，提供休閒與比賽桌球桌。',
            'capacity' => 30
        ]);
    }
}
