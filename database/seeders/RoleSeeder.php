<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'project-manager';
        $manager->description = 'Project Manager';
        $manager->save();

        $developer = new Role();
        $developer->name = 'web-developer';
        $developer->description = 'Web Developer';
        $developer->save();
    }
}
