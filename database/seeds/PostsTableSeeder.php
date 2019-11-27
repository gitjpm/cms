<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        for ($i=0; $i < 10; $i++) { 

            $random_user_id = DB::select('select id from users order by rand() limit 1')[0]->id;
        
            Post::create([
                'user_id' => $random_user_id,
                'title' => 'Post title '.random_int(4000, 6000),
                'content' => Lipsum::short()->text(3)
            ]);
        }
    }
}
