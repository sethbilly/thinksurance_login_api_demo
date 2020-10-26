<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'manage-users';
        $manageUser->description = 'Manage Users';
        $manageUser->save();

        $createTasks = new Permission();
        $createTasks->name = 'create-tasks';
        $createTasks->description = 'Create Tasks';
        $createTasks->save();
    }
}
