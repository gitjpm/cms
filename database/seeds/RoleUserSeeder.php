<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->delete();

        $roles = DB::select('select * from roles');
        $users = DB::select('select * from users');

        foreach ($users as $user) {
            $user_id = $user->id;
            $qty_of_roles_to_assign = random_int(1, count($roles));

            for ($i=0; $i < $qty_of_roles_to_assign; $i++) { 
                $now = new DateTime();
                $role_id = $roles[random_int(0, count($roles)-1)]->id;
                $role_exist = DB::select('select * from role_user where user_id = ? and role_id = ?', [$user_id, $role_id]);
                if(count($role_exist) == 0) // si no existe ese rol para ese user, lo insertamos
                    DB::insert('insert into role_user (role_id, user_id, created_at, updated_at) values (?, ?, ?, ?)', [$role_id, $user_id, $now, $now]);
            }
        }
    }
}
