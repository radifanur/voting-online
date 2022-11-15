<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'Admin',
            'username' => 'adminpemilu',
            'roles_id' => '1',
            'kelas_id' => '1',
            'password' => Hash::make('rahasianegara'),
            'token' => '00000',
            'verif' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Radifan Nur Aflah',
            'username' => 'ableh',
            'roles_id' => '2',
            'kelas_id' => '1',
            'password' => Hash::make('123456'),
            'token' => '11111',
            'verif' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
            'name' => 'Radifan Nur Aflah',
            'username' => '190202065',
            'roles_id' => '3',
            'kelas_id' => '1',
            'password' => Hash::make('190202065_'),
            'token' => '12345',
            'verif' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
