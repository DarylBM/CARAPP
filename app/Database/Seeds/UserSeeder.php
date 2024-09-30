<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Instantiate the UserModel
        $userModel = new \App\Models\UserModel();

        // Data for the admin accounts
        $data = [
            [
                'name' => 'Earl Garahe',
                'email' => 'admin1@example.com',
                'password' => password_hash('earlgarahe', PASSWORD_BCRYPT), // Hash the password
                'phone' => '1234567890',
                'address' => '123 Admin St.',
                'role_id' => 1, // Assuming 1 is the admin role ID
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Earl Garahe Two',
                'email' => 'admin2@example.com',
                'password' => password_hash('earlgarahe2', PASSWORD_BCRYPT),
                'phone' => '0987654321',
                'address' => '456 Admin Ave.',
                'role_id' => 1, // Assuming 1 is the admin role ID
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert each user into the database
        foreach ($data as $user) {
            $userModel->insert($user);
        }
    }
}
