<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'content' => '家事'
        ];
        Genre::create($param);
        $param = [
            'content' => '勉強'
        ];
        Genre::create($param);
        $param = [
            'content' => '運動'
        ];
        Genre::create($param);
        $param = [
            'content' => '食事'
        ];
        Genre::create($param);
        $param = [
            'content' => '移動'
        ];
        Genre::create($param);
    }
}
