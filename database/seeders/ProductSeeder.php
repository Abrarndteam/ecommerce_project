<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([

            [

                'name'=>'OnePlus Nord Mobile',
                "price"=>"80000",
                "description"=>"A smartphone with 5G support",
                "category"=>"mobile",
                "gallery"=>"https://th.bing.com/th/id/OIP.ednguLyOt_gTulbMVOw5rQHaE7?pid=ImgDet&rs=1",

            ],

            [

                'name'=>'OnePlus ',
                "price"=>"40000",
                "description"=>"A smartphone with 5G support",
                "category"=>"mobile",
                "gallery"=>"https://static0.srcdn.com/wordpress/wp-content/uploads/2021/03/oneplus-9-series-colors-official-render.jpeg",

            ]
        ]);
    }
}
