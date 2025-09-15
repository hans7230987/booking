<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court;
use App\Models\Venue;

class CourtSeeder extends Seeder
{
    public function run()
    {
        // 羽球館的球場
        $venue = Venue::where('name', '陽光羽球館')->first();
        Court::create([
            'name' => '羽球場 1',
            'type' => '羽球',
            'capacity' => 4,
            'venue_id' => $venue->id
        ]);
        Court::create([
            'name' => '羽球場 2',
            'type' => '羽球',
            'capacity' => 4,
            'venue_id' => $venue->id
        ]);

        // 籃球館的球場
        $venue = Venue::where('name', '快樂籃球館')->first();
        Court::create([
            'name' => '籃球場 A',
            'type' => '籃球',
            'capacity' => 10,
            'venue_id' => $venue->id
        ]);

        // 桌球館的球場
        $venue = Venue::where('name', '星光桌球館')->first();
        Court::create([
            'name' => '桌球桌 1',
            'type' => '桌球',
            'capacity' => 2,
            'venue_id' => $venue->id
        ]);
        Court::create([
            'name' => '桌球桌 2',
            'type' => '桌球',
            'capacity' => 2,
            'venue_id' => $venue->id
        ]);
    }
}
