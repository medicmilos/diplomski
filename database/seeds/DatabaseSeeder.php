<?php

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
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'remember_token' => NULL,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        //permissions and roles
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Super Admin',
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Administrator',
        ]);
        DB::table('role_users')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        //Add default cycle
        DB::statement("INSERT INTO cycles(id, lasts_until, name, begun) VALUES(1, '2022-01-01 00:00:00', 'Default cycle', 0)");

    }
}