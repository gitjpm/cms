<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $role_names = ['Admin', 'User', 'Subscriber'];

        foreach ($role_names as $role_name) {
            Role::create([
                'name' => $role_name
            ]);
        }
        
    }
}
