<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
test('un usuario autenticado puede actualizar su nombre, correo y contraseña', function () {
    $user = User::factory()->create([
        'name' => 'Nombre Actual',
        'email' => 'actual@example.com',
        'password' => Hash::make('12345678'),
    ]);

    Sanctum::actingAs($user);

    $response = $this->putJson('/api/user', [
        'name' => 'Nuevo Nombre',
        'email' => 'nuevo@example.com',
        'password' => '87654321',
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => 'Nuevo Nombre'])
        ->assertJsonFragment(['email' => 'nuevo@example.com']);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Nuevo Nombre',
        'email' => 'nuevo@example.com',
    ]);

    $user->refresh();

    expect(Hash::check('87654321', $user->password))->toBeTrue();
});