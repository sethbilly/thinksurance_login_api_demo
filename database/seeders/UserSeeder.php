<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = Role::where('name','web-developer')->first();
        $manager = Role::where('name', 'project-manager')->first();
        $createTasks = Permission::where('name','create-tasks')->first();
        $manageUsers = Permission::where('name','manage-users')->first();

        $user1 = new User();
        $user1->name = 'John Doe';
        $user1->email = 'john@doe.com';
        $user1->password = 'secret';
        $user1->save();
        $user1->roles()->attach($developer);
        $user1->permissions()->attach($createTasks);


        $user2 = new User();
        $user2->name = 'Mike Thomas';
        $user2->email = 'mike@thomas.com';
        $user2->password = 'secret';
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageUsers);
    }
}
