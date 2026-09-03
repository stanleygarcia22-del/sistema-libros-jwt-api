# sistema-libros-jwt-api
Implementación de Blindaje en APIs: Autenticación con JSON Web Tokens (JWT) y Gestión Segura de Credenciales

# 📚 API RESTful — Gestión de Libros con Autenticación JWT

API RESTful desarrollada con **Laravel 12**, **Eloquent ORM** y **JWT (JSON Web Tokens)** mediante el paquete `tymon/jwt-auth`. El sistema cuenta con endpoints públicos para la autenticación de usuarios y endpoints protegidos para la administración de un catálogo de libros.

---

## 🛠️ Requisitos e Instalación

1. **Clonar el repositorio:
   git clone [https://github.com/TU-USUARIO/sistema-libros-jwt-api.git](https://github.com/TU-USUARIO/sistema-libros-jwt-api.git)
   cd sistema-libros-jwt-api

2. Instalar dependencias de PHP: composer install

3. Configurar el entorno: 

cp .env.example .env
php artisan key:generate
php artisan jwt:secret

4. Ejecutar migraciones de la base de datos: php artisan migrate

5. Iniciar el servidor local: php artisan serve

La API estará disponible en: http://127.0.0.1:8000/api

Endpoints públicos

Método	Ruta	Descripción
POST	/api/auth/register	Registrar nuevo usuario
POST	/api/auth/login	Iniciar sesión y obtener token JWT
POST	/api/auth/logout	Cerrar sesión e invalidar token
GET	/api/auth/me	Obtener perfil del usuario autenticado

Endpoints protegidos

Método	Ruta	Descripción
GET	/api/books	Listar todos los libros
GET	/api/books/{id}	Obtener un libro específico
POST	/api/books	Crear un nuevo libro
PUT / PATCH	/api/books/{id}	Actualizar información de un libro
DELETE	/api/books/{id}	Eliminar un libro del catálogo

Ejemplos de Uso (Peticiones JSON)

1. Registro de Usuario (POST /api/auth/register)

{
  "name": "Carlos Méndez",
  "email": "carlos@example.com",
  "password": "password123"
}

2. Inicio de Sesión (POST /api/auth/login)

{
  "email": "carlos@example.com",
  "password": "password123"
}

Respuesta:

{
  "access_token": "eyJhbGciOiJIUzI1NiIsIn...",
  "token_type": "bearer",
  "expires_in": 3600
}

3. Crear un Libro (POST /api/books)
Header requerido: Authorization: Bearer <TU_TOKEN_JWT>

{
  "titulo": "Cien Años de Soledad",
  "autor": "Gabriel García Márquez",
  "descripcion": "Obra cumbre del realismo mágico.",
  "precio": 25.00,
  "disponible": true
}

Estructura Principal del Proyecto
- Modelos: app/Models/User.php, app/Models/Book.php
- Controladores API:
  - app/Http/Controllers/Api/AuthController.php
  - app/Http/Controllers/Api/BookController.php
- Rutas API: routes/api.php