<?php

namespace Database\Seeders;

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
        $this->call(AdminSeeder::class);
        \App\Models\User::factory(100)->create();
        $this->call(StudentSeeder::class);
        \App\Models\User::factory(20)->create();
        $this->call(TeacherSeeder::class);
        \App\Models\Group::factory(10)->create();
        \App\Models\GroupUser::factory(100)->create();
        \App\Models\TeacherDescription::factory(20)->create();
        \App\Models\Discipline::factory(25)->create();
        \App\Models\DisciplineUser::factory(50)->create();
        \App\Models\DisciplineGroup::factory(50)->create();
        \App\Models\Test::factory(150)->create();

    }
}
