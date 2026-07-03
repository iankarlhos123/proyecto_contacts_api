<?php

use App\Models\Contact;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


//Que cree un contacto
test('un usuario autenticado puede crear un contacto', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->postJson('/api/contacts', [
        'name' => 'Juan Perez',
        'phone_number' => '3001234567',
    ]);

    $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'Juan Perez']);

    $this->assertDatabaseHas('contacts', [
        'name' => 'Juan Perez',
        'user_id' => $user->id,
    ]);
});

//Que liste los contactos del usuario
test('un usuario puede listar solo sus propios contactos', function () {
    $user = User::factory()->create();
    $otroUsuario = User::factory()->create();

    
    Contact::factory(3)->create(['user_id' => $user->id]);
    
    Contact::factory(2)->create(['user_id' => $otroUsuario->id]);

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/contacts');

    $response->assertStatus(200)
        ->assertJsonCount(3); 
});

//No permite registrar un contacto con el mismo número de teléfono
test('no permite crear un contacto con un número de teléfono repetido para el mismo usuario', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    Contact::factory()->create([
        'user_id' => $user->id,
        'phone_number' => '3001234567',
    ]);

    $response = $this->postJson('/api/contacts', [
        'name' => 'Otro Contacto',
        'phone_number' => '3001234567',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors('phone_number');
});

//No permitir ver los contactos de otro usuario
test('un usuario no puede ver los contactos de otro usuario', function () {
    $user = User::factory()->create();
    $otroUsuario = User::factory()->create();

    $contactoAjeno = Contact::factory()->create(['user_id' => $otroUsuario->id]);

    Sanctum::actingAs($user);

    $response = $this->getJson("/api/contacts/{$contactoAjeno->id}");

    $response->assertStatus(403);
});