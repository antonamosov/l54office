<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'password' => bcrypt(getenv('APP_PASSWORD')),
            'email' => 'admin@back-office.ru'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
