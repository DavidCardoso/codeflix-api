<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeFlix\Models\User::class, 30)
//            todo: adicionar tratamento para states no model user
//            ->states('admin')
            ->create()
            ->each(function ($user){
                $user->verified = true;
                $user->save();
            });
    }
}
