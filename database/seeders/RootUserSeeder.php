<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'root@root.com',
                'password' => 'root123',
                'is_admin' => true,
                'admin_role' => User::ROLE_SUPER_ADMIN,
            ],
            [
                'name' => 'Admin Absensi',
                'email' => 'admin.absensi@mahad.test',
                'password' => 'absensi123',
                'is_admin' => true,
                'admin_role' => User::ROLE_ATTENDANCE_ADMIN,
            ],
            [
                'name' => 'Admin Artikel',
                'email' => 'admin.artikel@mahad.test',
                'password' => 'artikel123',
                'is_admin' => false,
                'admin_role' => User::ROLE_ARTICLE_ADMIN,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'is_admin' => $user['is_admin'],
                    'admin_role' => $user['admin_role'],
                ]
            );
        }
    }
}
