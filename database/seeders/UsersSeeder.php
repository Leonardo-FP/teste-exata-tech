<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password_admin = Str::random(12);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@exata.it',
            'password' => Hash::make($password_admin), 
        ]);
        $admin->assignRole('superadmin');

        $this->command->info("Usuário superadmin criado com a senha: $password_admin");

        $password_user = Str::random(12);

        $user = User::create([
            'name' => 'Usuário Comum',
            'email' => 'user@exata.it',
            'password' => Hash::make($password_user), 
        ]);
        $user->assignRole('user');

        $this->command->info("Usuário comum criado com a senha: $password_user");
    }
}
