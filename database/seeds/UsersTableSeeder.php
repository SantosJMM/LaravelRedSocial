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
        \App\User::truncate();
        \App\Models\Status::truncate();

        factory(\App\User::class)->create([
            'name' => 'admin07',
            'email' => 'admin@argon.com'
        ]);

        factory(\App\Models\Status::class, 10)->create();
    }
}
