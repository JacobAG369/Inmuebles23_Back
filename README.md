# Inmuebles23_Back
Backend API en Laravel para Inmuebles23.

## Requisitos
- PHP 8.2+
- Composer
- PostgreSQL

## Configuracion
1) Copia el archivo de entorno:
   - `cp .env.example .env`
2) Ajusta las variables de base de datos en `.env`.
3) Instala dependencias:
   - `composer install`
4) Genera la key:
   - `php artisan key:generate`
5) Ejecuta migraciones:
   - `php artisan migrate`
6) Levanta el servidor:
   - `php artisan serve`

## Autenticacion JWT
- POST `/api/login`
- POST `/api/register`
- GET `/api/me`
- POST `/api/logout`
- POST `/api/refresh`
