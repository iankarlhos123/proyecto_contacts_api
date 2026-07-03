<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactosBase = [
            ['name' => 'Juan Pérez',       'phone_number' => '3001111111'],
            ['name' => 'Ana Sánchez',      'phone_number' => '3002222222'],
            ['name' => 'Luis Fernández',   'phone_number' => '3003333333'],
            ['name' => 'Miles Morales',    'phone_number' => '3004444444'],
            ['name' => 'Ricardo Vargas',   'phone_number' => '3005555555'],
        ];

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            foreach ($contactosBase as $datosContacto) {
                Contact::create([
                    'name' => $datosContacto['name'],
                    'phone_number' => $datosContacto['phone_number'],
                    'user_id' => $usuario->id,
                ]);
            }
        }
    }
}
