<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            ['name' => 'Ian Carlos',       'email' => 'lian@gmail.com',       'password' => '12345678'],
            ['name' => 'María López',      'email' => 'maria@gmail.com',     'password' => '12345678'],
            ['name' => 'Carlos Ramírez',   'email' => 'carlos@gmail.com',    'password' => '12345678'],
            ['name' => 'Laura Gómez',      'email' => 'laura@gmail.com',     'password' => '12345678'],
            ['name' => 'Pedro Martínez',   'email' => 'pedro@gmail.com',     'password' => '12345678'],
            ['name' => 'Sofía Torres',     'email' => 'sofia@gmail.com',     'password' => '12345678'],
            ['name' => 'Andrés Rojas',     'email' => 'andres@gmail.com',    'password' => '12345678'],
            ['name' => 'Valentina Díaz',   'email' => 'valentina@gmail.com', 'password' => '12345678'],
            ['name' => 'Julián Castro',    'email' => 'julian@gmail.com',    'password' => '12345678'],
            ['name' => 'Camila Herrera',   'email' => 'camila@gmail.com',    'password' => '12345678'],
        ];
    
    
        foreach ($usuarios as $datosUsuario) {
            User::create([
                'name' => $datosUsuario['name'],
                'email' => $datosUsuario['email'],
                'password' => Hash::make($datosUsuario['password']),
            ]);
        }
    }
}