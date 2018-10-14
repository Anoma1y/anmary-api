<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class seed_categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Платья',
                'singular' => 'Платье',
                'description' => '',
            ],
            [
                'id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Сарафаны',
                'singular' => 'Сарафан',
                'description' => '',
            ],
            [
                'id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Брюки',
                'singular' => 'Брюки',
                'description' => '',
            ],
            [
                'id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Юбки',
                'singular' => 'Юбка',
                'description' => '',
            ],
            [
                'id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Блузы',
                'singular' => 'Блузка',
                'description' => '',
            ],            [
                'id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Кардиганы',
                'singular' => 'Кардиган',
                'description' => '',
            ],            [
                'id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Пиджаки',
                'singular' => 'Пиджак',
                'description' => '',
            ],
            [
                'id' => 8,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Жакеты',
                'singular' => 'Жакет',
                'description' => '',
            ],
            [
                'id' => 9,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Палантины',
                'singular' => 'Палантин',
                'description' => '',
            ],
            [
                'id' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'Кофты',
                'singular' => 'Кофта',
                'description' => '',
            ],
        ]);
    }
}
