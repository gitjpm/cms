<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        $tag_names = ['healthy', 'tech', 'shows', 'food', 'games'];

        foreach ($tag_names as $tag_name) {
            Tag::create([
                'name' => $tag_name    
            ]);
        }
        
    }
}
