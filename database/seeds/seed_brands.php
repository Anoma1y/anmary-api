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
                'description' => 'VAIDE - произведенная в Латвии одежда. Единожды проверив на себе свойства продукции Vaide, вы не останетесь равнодушными.',
                'country' => 'LV'
            ],
            [
                'id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'VITO FASHION',
                'description' => 'Компания VITO – это, прежде всего команда единомышленников, основной задачей которых является создание бренда, известность и популярность которого сопоставима с мировыми лидерами модной индустрии.',
                'country' => 'LV'
            ],
            [
                'id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'name' => 'TOP DESIGN',
                'description' => '«TopdesignBaltikum SIA» – латвийское швейно-трикотажное предприятие, основанное в 1994 году на базе латвийско-датской компании. Предприятие специализируется в изготовлении женской одежды из трикотажа.',
                'country' => 'LV'
            ],
        ]);
    }
}
