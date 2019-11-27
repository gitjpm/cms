<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->delete();

        $users = DB::select('select * from users');

        foreach($users as $user){
            Photo::create([
                'path' => 'user-foto'.random_int(10, 99).'.jpg',
                'imageable_id' => $user->id,
                'imageable_type' => 'App/User'
            ]);
        }

        $posts = DB::select('select * from posts');
        foreach($posts as $post){
            Photo::create([
                'path' => 'post-photo'.random_int(10, 99).'.jpg',
                'imageable_id' => $post->id,
                'imageable_type' => 'App/Post'
            ]);
        }

    }
}
