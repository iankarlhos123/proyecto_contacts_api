<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;


//Que se registre un usuario
test('un usuario puede registrarse correctamente', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Ian Carlos',
        'email' => 'ian@gmail.com',
        'password' => '12345678',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure(['message', 'user' => ['id', 'name', 'email']]);

    $this->assertDatabaseHas('users', [
        'email' => 'ian@gmail.com',
    ]);
});

//No permita registrar un usuario si ya está el correo registrado
test('no permite registrar un usuario con un correo ya existente', function () {
    
    User::factory()->create(['email' => 'ian@gmail.com']);

    $response = $this->postJson('/api/register', [
        'name' => 'Otro Usuario',
        'email' => 'ian@gmail.com',
        'password' => '12345678',
    ]);

    
    $response->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

//Que se actualice la información del usuario
test('un usuario autenticado puede actualizar su información', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->putJson('/api/user', [
        'name' => 'Nuevo Nombre',
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'Nuevo Nombre']);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Nuevo Nombre',
    ]);
});