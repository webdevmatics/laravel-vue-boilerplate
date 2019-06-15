<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create(['email'=>'webdevmatics@gmail.com']);
        Role::create(['name'=>'Admin']);

        $user->assignRole('Admin');
    }
}
