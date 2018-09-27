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

        $settings = array(
            array('id' => '1','key' => 'app_timezone','name' => 'App timezone','description' => 'App Timezone in GMT format','value' => 'GMT+1','field' => '{
                "name": "value",
                "type": "select_from_array",
                "label": "App Timezone",
                "options": {
                    "GMT-12": "GMT-12",
                    "GMT-11": "GMT-11",
                    "GMT-10": "GMT-10",
                    "GMT-9": "GMT-9",
                    "GMT-8": "GMT-8",
                    "GMT-7": "GMT-7",
                    "GMT-6": "GMT-6",
                    "GMT-5": "GMT-5",
                    "GMT-4": "GMT-4",
                    "GMT-3": "GMT-3",
                    "GMT-2": "GMT-2",
                    "GMT-1": "GMT-1",
                    "GMT+0": "GMT+0",
                    "GMT+1": "GMT+1",
                    "GMT+2": "GMT+2",
                    "GMT+3": "GMT+3",
                    "GMT+4": "GMT+4",
                    "GMT+5": "GMT+5",
                    "GMT+6": "GMT+6",
                    "GMT+7": "GMT+7",
                    "GMT+8": "GMT+8",
                    "GMT+9": "GMT+9",
                    "GMT+10": "GMT+10",
                    "GMT+11": "GMT+11",
                    "GMT+12": "GMT+12"
                }
            }','active' => '1'),
            array('id' => '2','key' => 'autoApprove','name' => 'Auto approve gallery photos','description' => 'Check this option if you want gallery uploads to be automatically approved.','value' => 1,'field' => '{
                "name": "value",
                "type": "checkbox",
                "label": "Auto approve gallery photos"
            }','active' => '1')
        );
        DB::table('settings')->insert($settings);

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
        DB::statement("INSERT INTO cycles(id, lasts_until, name, begun) VALUES(1, '2036-01-01 00:00:00', 'Default cycle', 0)");

    }
}
