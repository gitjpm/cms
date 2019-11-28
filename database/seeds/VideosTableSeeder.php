<?php

use App\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->delete();

        for ($i=0; $i < 10; $i++) { 
            Video::create([
                'name' => strtoupper(Str::random(15)).'.mov'
            ]);
        }
    }
}
