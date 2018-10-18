<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class seed_brands extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Vaide',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'VITO FASHION',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'TOP DESIGN',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Valeria LUX',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'DOMINICO MORANI',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'ERWE',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Comvill L',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Stillon',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'ALINAFASHION',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'МЕЛАНИ',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 11,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'BRAVISSIMO',
                'description' => '',
                'country' => 'RU'
            ],
            [
                'id' => 12,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'EFFENZA',
                'description' => '',
                'country' => 'LV'
            ],


            [
                'id' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'MAGNOLICA',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 14,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'VonFlaibach',
                'description' => '',
                'country' => 'DE'
            ],
            [
                'id' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Laureta',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 16,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'GALIANI STEFANI',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 17,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Natali Silhuette',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 18,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'OLMAR',
                'description' => '',
                'country' => 'PL'
            ],
            [
                'id' => 19,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'ANCORA',
                'description' => '',
                'country' => 'PL'
            ],
            [
                'id' => 20,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'OZO',
                'description' => '',
                'country' => 'FR'
            ],
            [
                'id' => 21,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'MADO',
                'description' => '',
                'country' => 'FR'
            ],
            [
                'id' => 22,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'FA Concept',
                'description' => '',
                'country' => 'FR'
            ],
            [
                'id' => 23,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Deja Fashion',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 24,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Lissa',
                'description' => '',
                'country' => 'LV'
            ],
            [
                'id' => 25,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Emka Fashion',
                'description' => '',
                'country' => 'RU'
            ],
        ]);
    }
}
