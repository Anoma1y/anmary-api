<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class seed_sizes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sizes')->insert([
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'XXS',
                'ru' => '38',
                'it' => '36/0',
                'us' => '0',
                'eu' => '32',
                'uk' => '4/30',
                'jp' => '3',
                'chest' => '76 см.',
                'waist' => '58 см.',
                'thigh' => '82 см.',
                'sleeve' => '58-60 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'XS',
                'ru' => '40',
                'it' => '38/I',
                'us' => '2',
                'eu' => '34',
                'uk' => '6/32',
                'jp' => '5',
                'chest' => '80 см.',
                'waist' => '62 см.',
                'thigh' => '86 см.',
                'sleeve' => '59-61 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'S',
                'ru' => '42',
                'it' => '40/II',
                'us' => '4',
                'eu' => '36',
                'uk' => '8/34',
                'jp' => '7',
                'chest' => '84 см.',
                'waist' => '66 см.',
                'thigh' => '92 см.',
                'sleeve' => '59-61 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'M',
                'ru' => '44',
                'it' => '42/III',
                'us' => '6',
                'eu' => '38',
                'uk' => '10/36',
                'jp' => '9',
                'chest' => '88 см.',
                'waist' => '70 см.',
                'thigh' => '96 см.',
                'sleeve' => '60-62 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'M',
                'ru' => '46',
                'it' => '44/IV',
                'us' => '8',
                'eu' => '40',
                'uk' => '12/38',
                'jp' => '11',
                'chest' => '92 см.',
                'waist' => '74 см.',
                'thigh' => '100 см.',
                'sleeve' => '60-62 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'L',
                'ru' => '48',
                'it' => '46/V',
                'us' => '10',
                'eu' => '42',
                'uk' => '14/40',
                'jp' => '13',
                'chest' => '96 см.',
                'waist' => '78 см.',
                'thigh' => '104 см.',
                'sleeve' => '60-62 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'L',
                'ru' => '50',
                'it' => '48/VI',
                'us' => '12',
                'eu' => '44',
                'uk' => '16/42',
                'jp' => '15',
                'chest' => '100 см.',
                'waist' => '82 см.',
                'thigh' => '108 см.',
                'sleeve' => '61-63 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'XL',
                'ru' => '52',
                'it' => '50/VII',
                'us' => '14',
                'eu' => '46',
                'uk' => '18/44',
                'jp' => '17',
                'chest' => '104 см.',
                'waist' => '86 см.',
                'thigh' => '112 см.',
                'sleeve' => '61-63 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'XXL',
                'ru' => '54',
                'it' => '52/VIII',
                'us' => '16',
                'eu' => '48',
                'uk' => '20/46',
                'jp' => '19',
                'chest' => '108 см.',
                'waist' => '90 см.',
                'thigh' => '116 см.',
                'sleeve' => '61-63 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'XXL',
                'ru' => '56',
                'it' => '54/IX',
                'us' => '18',
                'eu' => '50',
                'uk' => '22/48',
                'jp' => '21',
                'chest' => '112 см.',
                'waist' => '94 см.',
                'thigh' => '120 см.',
                'sleeve' => '61-63 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => 'XXXL',
                'ru' => '58',
                'it' => '56/X',
                'us' => '20',
                'eu' => '52',
                'uk' => '24/50',
                'jp' => '23',
                'chest' => '116 см.',
                'waist' => '98 см.',
                'thigh' => '124 см.',
                'sleeve' => '62-64 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => '4XL',
                'ru' => '60',
                'it' => '58/XI',
                'us' => '22',
                'eu' => '54',
                'uk' => '26/52',
                'jp' => '25',
                'chest' => '120 см.',
                'waist' => '100 см.',
                'thigh' => '128 см.',
                'sleeve' => '62-64 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => '4XL',
                'ru' => '62',
                'it' => '60/XII',
                'us' => '24',
                'eu' => '56',
                'uk' => '28/54',
                'jp' => '27',
                'chest' => '124 см.',
                'waist' => '104 см.',
                'thigh' => '132 см.',
                'sleeve' => '62.5-65 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => '4XL',
                'ru' => '64',
                'it' => '62/XIII',
                'us' => '26',
                'eu' => '58',
                'uk' => '30/56',
                'jp' => '29',
                'chest' => '128 см.',
                'waist' => '108 см.',
                'thigh' => '136 см.',
                'sleeve' => '62.5-65 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => '5XL',
                'ru' => '66',
                'it' => '64/XIV',
                'us' => '28',
                'eu' => '60',
                'uk' => '32/58',
                'jp' => '31',
                'chest' => '132 см.',
                'waist' => '112 см.',
                'thigh' => '140 см.',
                'sleeve' => '62.5-65 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => '5XL',
                'ru' => '68',
                'it' => '66/XV',
                'us' => '30',
                'eu' => '62',
                'uk' => '34/60',
                'jp' => '33',
                'chest' => '136 см.',
                'waist' => '116 см.',
                'thigh' => '144 см.',
                'sleeve' => '62.5-65 см.'
            ],
            [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'international' => '5XL',
                'ru' => '70',
                'it' => '68/XVI',
                'us' => '32',
                'eu' => '64',
                'uk' => '36/62',
                'jp' => '35',
                'chest' => '140 см.',
                'waist' => '120 см.',
                'thigh' => '148 см.',
                'sleeve' => '62.5-65 см.'
            ],

        ]);

    }
}
