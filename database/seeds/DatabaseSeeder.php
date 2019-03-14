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
            'name'=> 'Administrator',
            'role_id' => 1,
            'is_active' => 1,
            'email'=> 'administrator@email.com',
            'password' => bcrypt('admin123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => 'NULL',
            'photo_id' => '1'
        ]);

        DB::table('photos')->insert([
            'file' => 'placeholder.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL
        ]);


        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => 'NULL',
            ],
            [
                'name' => 'autor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => 'NULL',
            ],
            [
                'name' => 'pretplatnik',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => 'NULL',
            ]
        ]);
    }
}
