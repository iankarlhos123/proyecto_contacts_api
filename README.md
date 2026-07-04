<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Contacts API
API REST hecha en Laravel para gestionar usuarios y sus contactos personales. Cada usuario autenticado solo puede ver, crear, actualizar y eliminar sus propios contactos.
Requisitos previos
Antes de clonar el proyecto, asegúrate de tener instalado:

PHP >= 8.2
Composer
MySQL 
Git

1. Clonar el repositorio

git clone https://github.com/iankarlhos123/proyecto_contacts_api.git

2. Muevete al proyecto 

cd proyecto_contacts_api

3. Instalar dependencias de PHP

composer install

4. Configurar el archivo de entorno

Copia el archivo de ejemplo:

cp .env.example .env

Genera la clave de la aplicación:

php artisan key:generate

5. Configurar la base de datos
Abre el archivo .env y edita estas líneas con tus datos de MySQL:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contacts_api
DB_USERNAME=root
DB_PASSWORD=tu_contraseña

Crea la base de datos en MySQL:

CREATE DATABASE contacts_api;

6. Ejecutar migraciones y poblar la base de datos

php artisan migrate:fresh --seed

Esto crea todas las tablas necesarias y las llena con datos de prueba: 10 usuarios, cada uno con 5 contactos.

7. Levantar el servidor

php artisan serve

La API quedará disponible en:

http://127.0.0.1:8000

8. Correr los tests
El proyecto usa Pest como framework de testing. Para correr todos los tests:

php artisan test

Qué cubren los tests:
tests/Feature/AuthTest.php

Registro de usuario exitoso
Rechazo de registro con correo ya existente
Actualización de información del usuario autenticado

tests/Feature/ContactsTest.php

Creación de contacto
Listado de contactos (solo los del usuario autenticado)
Rechazo de contacto con número de teléfono repetido (para el mismo usuario)
Bloqueo de acceso a contactos de otro usuario

9. Probar los endpoints con curl

Registrar un usuario:

```bash
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"name":"Ian karlhos","email":"ianks@gmail.com","password":"12345678"}'
```

Iniciar sesión:

```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"ianks@gmail.com","password":"12345678"}'
```

Copia el token que devuelve la respuesta, lo vas a necesitar en las siguientes peticiones.

Actualizar información del usuario:

```bash
curl -X PUT http://127.0.0.1:8000/api/user \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN" \
  -d '{"name":"Nuevo Nombre","email":"nuevo@example.com","password":"nueva_contrasena_123"}'
```

Crear un contacto:

```bash
curl -X POST http://127.0.0.1:8000/api/contacts \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN" \
  -d '{"name":"Juan Perez","phone_number":"3001234567"}'
```

Listar tus contactos:

```bash
curl -X GET http://127.0.0.1:8000/api/contacts \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN"
```

Ver un contacto específico:

```bash
curl -X GET http://127.0.0.1:8000/api/contacts/51 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN"
```

Actualizar un contacto:

```bash
curl -X PUT http://127.0.0.1:8000/api/contacts/51 \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN" \
  -d '{"name":"Nombre Actualizado","phone_number":"3009998848"}'
```

Eliminar un contacto:

```bash
curl -X DELETE http://127.0.0.1:8000/api/contacts/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN"
```

Cerrar sesión:

```bash
curl -X POST http://127.0.0.1:8000/api/logout \
  -H "Accept: application/json" \
  -H "Authorization: Bearer TU_TOKEN"
```

