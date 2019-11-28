<?php

use App\Taggable;
use Illuminate\Database\Seeder;

class TaggableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = DB::select('select id from tags');

        // buscaremos todos los posts y videos para vincularlos a algunos tags
        $posts = DB::select('select id from posts');
        $videos = DB::select('select id from videos');     

        foreach ($videos as $video) {
            // cuantos tags queremos añadir a este video (de 0 a total tags)
            $tags_qty = random_int(0, count($tags));
            for ($i=0; $i < $tags_qty; $i++) { 
                
                $tag_index = random_int(0, $tags_qty-1);
                $tag_id = $tags[$tag_index]->id;             
                
                Taggable::create([
                    'tag_id' => $tag_id,
                    'taggable_id' => $video->id,
                    'taggable_type' => 'App\Video'
                ]);
            }
        }

        foreach ($posts as $post) {
            // cuantos tags queremos añadir a este post (de 0 a total tags)
            $tags_qty = random_int(0, count($tags));
            for ($i=0; $i < $tags_qty; $i++) { 
                $tag_index = random_int(0, $tags_qty-1);
                $tag_id = $tags[$tag_index]->id;

                Taggable::create([
                    'tag_id' => $tag_id,
                    'taggable_id' => $post->id,
                    'taggable_type' => 'App\Post'
                ]);
            }
        }


    }
}
