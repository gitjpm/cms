<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->command->info('Users inserted!');
        $this->call(RoleUserSeeder::class);
        $this->command->info('Roles assigned to Users!');
        $this->call(PostsTableSeeder::class);
        $this->command->info('Posts inserted!');

    }
}
