<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueCourtSeeder extends Seeder
{
    public function run(): void
    {
        $venues = [
            ['name' => '陽光運動館', 'address' => '台北市信義區松高路1號', 'phone' => '02-1234-5678', 'description' => '設備完善，適合各種運動。'],
            ['name' => '星光球館', 'address' => '新北市板橋區文化路2號', 'phone' => '02-2345-6789', 'description' => '專業球場，教練團隊優秀。'],
            ['name' => '運動天地', 'address' => '台中市西區公益路3號', 'phone' => '04-3456-7890', 'description' => '籃球、羽球、桌球多功能運動館。'],
            ['name' => '活力運動館', 'address' => '台南市東區中華路4號', 'phone' => '06-4567-8901', 'description' => '適合各年齡層的運動空間。'],
            ['name' => '奧林匹克體育館', 'address' => '高雄市苓雅區中正路5號', 'phone' => '07-5678-9012', 'description' => '大型多功能運動館。'],
            ['name' => '星際運動館', 'address' => '台北市大安區復興南路6號', 'phone' => '02-6789-0123', 'description' => '舒適環境，設施齊全。'],
            ['name' => '活力球館', 'address' => '新北市新店區北新路7號', 'phone' => '02-7890-1234', 'description' => '專業籃球、桌球與羽球場地。'],
            ['name' => '飛揚運動館', 'address' => '桃園市中壢區中華路8號', 'phone' => '03-8901-2345', 'description' => '適合團體活動及個人運動。'],
            ['name' => '晨曦運動館', 'address' => '台中市北區育才街9號', 'phone' => '04-9012-3456', 'description' => '全天候開放，設備完善。'],
            ['name' => '快樂運動館', 'address' => '高雄市左營區自由路10號', 'phone' => '07-0123-4567', 'description' => '運動愛好者的最佳選擇。'],
        ];

        $types = ['籃球', '羽球', '桌球'];

        foreach ($venues as $venue) {
            $venueId = DB::table('venues')->insertGetId($venue);

            $numCourts = rand(5, 10); // 每個場館 5~10 球場
            for ($i = 1; $i <= $numCourts; $i++) {
                DB::table('courts')->insert([
                    'venue_id' => $venueId,
                    'name' => $venue['name'] . ' 球場 ' . $i,
                    'type' => $types[array_rand($types)],
                    'status' => '可用',
                ]);
            }
        }
    }
}
