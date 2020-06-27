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
        DB::table('users')->insert([
            'name' => 'Testador',
            'email' => 'testador@cap.com',
            'password' => Hash::make('123456'),
            'balance' => 0,
            'agency' => '0001',
            'account' => '123456',
        ]);
    }
}
