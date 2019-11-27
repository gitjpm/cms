<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i=0; $i < 10; $i++) { 
            $x = random_int(1000, 4000);
            User::create([
                'name' => 'User - '.$x,
                'email' => 'user'.$x.'@email.com',
                'password' => $x
            ]);
        }
        
    }
}
