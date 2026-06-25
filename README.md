# API de Gestión de Empleados, Cargos y Funciones

API REST desarrollada con Laravel 13.16.1 para la gestión de empleados, cargos y funciones asociadas a cada cargo.

El proyecto implementa autenticación mediante Laravel Sanctum, validaciones de datos con mensajes personalizados, relaciones entre tablas mediante Eloquent ORM, generación automática de datos con Seeders y Factories, paginación y pruebas automatizadas utilizando PHPUnit.

La aplicación permite realizar operaciones CRUD sobre empleados, cargos y funciones, además de consultar:

- Las funciones asociadas a un cargo.
- El detalle completo de un empleado, incluyendo nombre, cargo asignado, salario y funciones asociadas al cargo.

Las únicas rutas públicas son el registro de usuarios y el inicio de sesión. Todos los demás endpoints se encuentran protegidos mediante autenticación con tokens de Laravel Sanctum.

# Tecnologías Utilizadas

- PHP 8.4
- Laravel Framework 13.16.1
- MySQL
- Laravel Sanctum
- PHPUnit
- Composer
- Git

# Requerimientos

- PHP 8.4 o superior
- Laravel 13
- Composer
- MySQL
- Laravel Sanctum
- PHPUnit
- Git

# Instalación del proyecto

## 1. Clonar el repositorio

Abrir Git Bash y ejecutar:

```bash
git clone https://github.com/sheyland1727-design/Evaluacion-Api.git
```

Ingresar a la carpeta del proyecto:

```bash
cd Evaluacion-Api
```

## 2. Instalar dependencias

Ejecutar el siguiente comando:

```bash
composer install
```

## 3. Crear el archivo de entorno

Copiar el archivo de configuración de ejemplo para crear el archivo `.env`:

```bash
cp .env.example .env
```

Después de ejecutar el comando anterior, el proyecto contará con un archivo de configuración llamado:

```text
.env
```

## 4. Generar la clave de la aplicación

Ejecutar:

```bash
php artisan key:generate
```

## 5. Configurar la base de datos

Abrir el archivo `.env` y configurar las siguientes variables:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_3066552
DB_USERNAME=root
DB_PASSWORD=
```

## 6. Crear la base de datos

Si la base de datos aún no existe, crearla mediante el siguiente comando:

```sql
CREATE DATABASE db_3066552;
```

O desde la terminal de MySQL:

Ingresar a MySQL:

```bash
mysql -u root -p
```

Ejecutar:

```sql
CREATE DATABASE db_3066552;
```

Verificar que fue creada correctamente:

```sql
SHOW DATABASES;
```

## 7. Ejecutar migraciones y seeders

Ejecutar el siguiente comando:

```bash
php artisan migrate --seed
```

Este comando creará automáticamente las tablas de la base de datos y cargará los datos iniciales definidos en los seeders.

### Datos generados automáticamente

Al ejecutar los seeders se generan:

- 40 cargos.
- 200 funciones de cargo (5 funciones por cada cargo).
- 30 empleados distribuidos entre los cargos existentes.

Estos datos permiten probar inmediatamente los endpoints de la API sin necesidad de registrar información manualmente.

## 8. Iniciar servidor

Ejecutar:

```bash
php artisan serve
```

La API estará disponible en:

```text
http://127.0.0.1:8000
```

# Seguridad y Acceso a los Endpoints

La API utiliza autenticación mediante Laravel Sanctum.

## Rutas públicas

Las siguientes rutas no requieren autenticación:

| Método | Endpoint | Descripción |
|----------|----------|----------|
| POST | /api/register | Registrar un nuevo usuario |
| POST | /api/login | Iniciar sesión y obtener token |


## Rutas protegidas

Las siguientes rutas requieren un token de autenticación válido enviado en el encabezado:

```http
Authorization: Bearer TU_TOKEN_GENERADO
```

### Empleados

GET /api/empleados

GET /api/empleados/{id}

POST /api/empleados

PUT /api/empleados/{id}

DELETE /api/empleados/{id}

GET /api/empleados/{id}/detalle

### Cargos

GET /api/cargos

GET /api/cargos/{id}

POST /api/cargos

PUT /api/cargos/{id}

DELETE /api/cargos/{id}

GET /api/cargos/{id}/funciones

### Funciones

GET /api/funciones

GET /api/funciones/{id}

POST /api/funciones

PUT /api/funciones/{id}

DELETE /api/funciones/{id}

### Cerrar sesión

POST /api/logout

Si se intenta acceder a una ruta protegida sin un token válido, la API devolverá un error de autenticación.

# Registro de Usuario

## Endpoint

```http
POST /api/register
```

## Ejemplo de solicitud

```json
{
    "name": "Sheila Gomez",
    "email": "sheila@correo.com",
    "password": "12345678",
    "password_confirmation": "12345678"
}
```

## Ejemplo de respuesta exitosa

```json
{
    "message": "Usuario registrado correctamente.",
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxx"
}
```

## Posibles errores de validación

```json
{
    "message": "El nombre es obligatorio."
}
```

```json
{
    "message": "El correo ya está registrado."
}
```

```json
{
    "message": "Las contraseñas no coinciden."
}
```

# Inicio de Sesión

## Endpoint

```http
POST /api/login
```

## Ejemplo de solicitud

```json
{
    "email": "sheila@correo.com",
    "password": "12345678"
}
```

## Ejemplo de respuesta exitosa

```json
{
    "message": "Inicio de sesión exitoso.",
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxx"
}
```

## Ejemplo de credenciales incorrectas

```json
{
    "message": "Credenciales incorrectas."
}
```

# Uso del Token

Después de iniciar sesión, el token generado debe enviarse en todas las peticiones protegidas mediante el encabezado:

```http
Authorization: Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxx
```

# Cerrar Sesión

## Endpoint

```http
POST /api/logout
```

## Ejemplo de respuesta

```json
{
    "message": "Sesión cerrada correctamente."
}
```

Este endpoint elimina el token utilizado en la sesión actual.

# CRUD Cargos

Todos los endpoints de esta sección requieren autenticación mediante Laravel Sanctum.

## 1. Listar cargos

Obtiene todos los cargos registrados.

### Método

```http
GET
```

### Endpoint

```http
/api/cargos
```

### Ejemplo

```http
GET /api/cargos?page=1
```

### Respuesta exitosa

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "nombre_cargo": "Desarrollador Backend",
            "descripcion": "Responsable del desarrollo de APIs."
        }
    ]
}
```

---

## 2. Consultar un cargo

Obtiene la información de un cargo específico.

### Método

```http
GET
```

### Endpoint

```http
/api/cargos/{id}
```

### Ejemplo

```http
GET /api/cargos/1
```

### Respuesta exitosa

```json
{
    "id": 1,
    "nombre_cargo": "Desarrollador Backend",
    "descripcion": "Responsable del desarrollo de APIs."
}
```

### Si el cargo no existe

```json
{
    "message": "Cargo no existe"
}
```

---

## 3. Crear cargo

Permite registrar un nuevo cargo.

### Método

```http
POST
```

### Endpoint

```http
/api/cargos
```

### Body

```json
{
    "nombre_cargo": "Analista de Sistemas",
    "descripcion": "Encargado del análisis de requerimientos."
}
```

### Respuesta exitosa

```json
{
    "message": "Cargo creado correctamente.",
    "data": {
        "id": 41,
        "nombre_cargo": "Analista de Sistemas",
        "descripcion": "Encargado del análisis de requerimientos."
    }
}
```

### Posibles errores de validación

```json
{
    "message": "El nombre del cargo es obligatorio."
}
```

```json
{
    "message": "La descripción es obligatoria."
}
```

---

## 4. Actualizar cargo

Permite modificar la información de un cargo existente.

### Método

```http
PUT
```

### Endpoint

```http
/api/cargos/{id}
```

### Body

```json
{
    "nombre_cargo": "Arquitecto de Software",
    "descripcion": "Diseño de soluciones empresariales."
}
```

### Respuesta exitosa

```json
{
    "message": "Cargo actualizado correctamente.",
    "data": {
        "id": 1,
        "nombre_cargo": "Arquitecto de Software",
        "descripcion": "Diseño de soluciones empresariales."
    }
}
```

### Si el cargo no existe

```json
{
    "message": "Cargo no existe"
}
```

---

## 5. Eliminar cargo

Permite eliminar un cargo existente.

### Método

```http
DELETE
```

### Endpoint

```http
/api/cargos/{id}
```

### Respuesta exitosa

```json
{
    "message": "Cargo eliminado correctamente."
}
```

### Si el cargo no existe

```json
{
    "message": "Cargo no existe"
}
```

---

## 6. Consultar funciones de un cargo

Obtiene todas las funciones asociadas a un cargo específico.

### Método

```http
GET
```

### Endpoint

```http
/api/cargos/{id}/funciones
```

### Ejemplo

```http
GET /api/cargos/1/funciones?page=1
```

### Respuesta exitosa

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "cargo_id": 1,
            "descripcion_funcion": "Desarrollar APIs REST",
            "estado": true
        },
        {
            "id": 2,
            "cargo_id": 1,
            "descripcion_funcion": "Mantener servicios backend",
            "estado": true
        }
    ]
}
```

### Si el cargo no existe

```json
{
    "message": "Cargo no existe"
}
```

# CRUD Funciones de Cargo

Todos los endpoints de esta sección requieren autenticación mediante Laravel Sanctum.

## 1. Listar funciones de cargo

Obtiene todas las funciones registradas.

### Método

```http
GET
```

### Endpoint

```http
/api/funciones
```

### Ejemplo

```http
GET /api/funciones?page=1
```

### Respuesta exitosa

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "cargo_id": 1,
            "descripcion_funcion": "Desarrollar APIs REST",
            "estado": true
        }
    ]
}
```

---

## 2. Consultar una función

Obtiene la información de una función específica.

### Método

```http
GET
```

### Endpoint

```http
/api/funciones/{id}
```

### Ejemplo

```http
GET /api/funciones/1
```

### Respuesta exitosa

```json
{
    "id": 1,
    "cargo_id": 1,
    "descripcion_funcion": "Desarrollar APIs REST",
    "estado": true
}
```

### Si la función no existe

```json
{
    "message": "Función no existe"
}
```

---

## 3. Crear función de cargo

Permite registrar una nueva función asociada a un cargo.

### Método

```http
POST
```

### Endpoint

```http
/api/funciones
```

### Body

```json
{
    "cargo_id": 1,
    "descripcion_funcion": "Gestionar inventario",
    "estado": true
}
```

### Respuesta exitosa

```json
{
    "message": "Función creada correctamente.",
    "data": {
        "id": 201,
        "cargo_id": 1,
        "descripcion_funcion": "Gestionar inventario",
        "estado": true
    }
}
```

---

## 4. Actualizar función de cargo

Permite modificar una función existente.

### Método

```http
PUT
```

### Endpoint

```http
/api/funciones/{id}
```

### Body

```json
{
    "cargo_id": 1,
    "descripcion_funcion": "Gestionar inventario y existencias",
    "estado": true
}
```

### Respuesta exitosa

```json
{
    "message": "Función actualizada correctamente.",
    "data": {
        "id": 1,
        "cargo_id": 1,
        "descripcion_funcion": "Gestionar inventario y existencias",
        "estado": true
    }
}
```

### Si la función no existe

```json
{
    "message": "Función no existe"
}
```

---

## 5. Eliminar función de cargo

Permite eliminar una función existente.

### Método

```http
DELETE
```

### Endpoint

```http
/api/funciones/{id}
```

### Respuesta exitosa

```json
{
    "message": "Función eliminada correctamente."
}
```

### Si la función no existe

```json
{
    "message": "Función no existe"
}
```

# CRUD Empleados

Todos los endpoints de esta sección requieren autenticación mediante Laravel Sanctum.

## 1. Listar empleados

Obtiene todos los empleados registrados.

### Método

```http
GET
```

### Endpoint

```http
/api/empleados
```

### Ejemplo

```http
GET /api/empleados?page=1
```

### Respuesta exitosa

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "cargo_id": 1,
            "nombres": "Juan",
            "apellidos": "Perez",
            "fecha_nacimiento": "2000-01-15",
            "fecha_ingreso": "2024-01-10",
            "salario": 2500,
            "estado": true
        }
    ]
}
```

---

## 2. Consultar un empleado

Obtiene la información de un empleado específico.

### Método

```http
GET
```

### Endpoint

```http
/api/empleados/{id}
```

### Ejemplo

```http
GET /api/empleados/1
```

### Respuesta exitosa

```json
{
    "id": 1,
    "cargo_id": 1,
    "nombres": "Juan",
    "apellidos": "Perez",
    "fecha_nacimiento": "2000-01-15",
    "fecha_ingreso": "2024-01-10",
    "salario": 2500,
    "estado": true
}
```

### Si el empleado no existe

```json
{
    "message": "Empleado no existe"
}
```

---

## 3. Crear empleado

Permite registrar un nuevo empleado.

### Método

```http
POST
```

### Endpoint

```http
/api/empleados
```

### Body

```json
{
    "cargo_id": 1,
    "nombres": "Juan",
    "apellidos": "Perez",
    "fecha_nacimiento": "2000-01-15",
    "fecha_ingreso": "2024-01-10",
    "salario": 2500,
    "estado": true
}
```

### Respuesta exitosa

```json
{
    "message": "Empleado creado correctamente.",
    "data": {
        "id": 31,
        "cargo_id": 1,
        "nombres": "Juan",
        "apellidos": "Perez",
        "fecha_nacimiento": "2000-01-15",
        "fecha_ingreso": "2024-01-10",
        "salario": 2500,
        "estado": true
    }
}
```

---

## 4. Actualizar empleado

Permite modificar la información de un empleado existente.

### Método

```http
PUT
```

### Endpoint

```http
/api/empleados/{id}
```

### Body

```json
{
    "cargo_id": 1,
    "nombres": "Juan Carlos",
    "apellidos": "Perez",
    "fecha_nacimiento": "2000-01-15",
    "fecha_ingreso": "2024-01-10",
    "salario": 3000,
    "estado": true
}
```

### Respuesta exitosa

```json
{
    "message": "Empleado actualizado correctamente.",
    "data": {
        "id": 1,
        "cargo_id": 1,
        "nombres": "Juan Carlos",
        "apellidos": "Perez",
        "fecha_nacimiento": "2000-01-15",
        "fecha_ingreso": "2024-01-10",
        "salario": 3000,
        "estado": true
    }
}
```

### Si el empleado no existe

```json
{
    "message": "Empleado no existe"
}
```

---

## 5. Eliminar empleado

Permite eliminar un empleado existente.

### Método

```http
DELETE
```

### Endpoint

```http
/api/empleados/{id}
```

### Respuesta exitosa

```json
{
    "message": "Empleado eliminado correctamente."
}
```

### Si el empleado no existe

```json
{
    "message": "Empleado no existe"
}
```

---

## 6. Detalle de empleado

Obtiene el detalle completo de un empleado, incluyendo el cargo asignado y las funciones asociadas a dicho cargo.

### Método

```http
GET
```

### Endpoint

```http
/api/empleados/{id}/detalle
```

### Ejemplo

```http
GET /api/empleados/1/detalle
```

### Respuesta exitosa

```json
{
    "id": 1,
    "nombres": "Juan",
    "apellidos": "Perez",
    "salario": 2500,
    "cargo": {
        "id": 1,
        "nombre_cargo": "Desarrollador Backend"
    },
    "funciones": [
        {
            "id": 1,
            "descripcion_funcion": "Desarrollar APIs REST",
            "estado": true
        },
        {
            "id": 2,
            "descripcion_funcion": "Mantener servicios backend",
            "estado": true
        }
    ]
}
```

### Si el empleado no existe

```json
{
    "message": "Empleado no existe"
}
```

# Pruebas Automatizadas

La API incluye pruebas automatizadas desarrolladas con PHPUnit para verificar el correcto funcionamiento de los endpoints y la autenticación.

## Ejecutar pruebas

Desde la raíz del proyecto ejecutar:

```bash
php artisan test
```

## Pruebas de la API con Git Bash

### 1. Registrar usuario

```bash
curl -X POST http://127.0.0.1:8000/api/register \
-H "Content-Type: application/json" \
-d '{"name":"Juan Perez","email":"juan@gmail.com","password":"12345678","password_confirmation":"12345678"}'
```

Respuesta esperada:

```json
{
  "message": "Usuario registrado correctamente.",
  "token": "TOKEN_GENERADO"
}
```

---

### 2. Iniciar sesión

```bash
curl -X POST http://127.0.0.1:8000/api/login \
-H "Content-Type: application/json" \
-d '{"email":"juan@gmail.com","password":"12345678"}'
```

Respuesta esperada:

```json
{
  "message": "Inicio de sesión exitoso.",
  "token": "TOKEN_GENERADO"
}
```

**Importante:** Copiar el token generado y reemplazar `TU_TOKEN` en las siguientes peticiones.

---

### 3. Consultar cargos (paginados)

```bash
curl -X GET "http://127.0.0.1:8000/api/cargos?page=1" \
-H "Authorization: Bearer TU_TOKEN"
```

Respuesta esperada:

```json
{
  "current_page": 1,
  "data": [...],
  "last_page": 4,
  "per_page": 10,
  "total": 40
}
```

---

### 4. Consultar funciones de cargo (paginadas)

```bash
curl -X GET "http://127.0.0.1:8000/api/funciones?page=1" \
-H "Authorization: Bearer TU_TOKEN"
```

Respuesta esperada:

```json
{
  "current_page": 1,
  "data": [...],
  "last_page": 4,
  "per_page": 10,
  "total": 40
}
```

---

### 5. Consultar empleados (paginados)

```bash
curl -X GET "http://127.0.0.1:8000/api/empleados?page=1" \
-H "Authorization: Bearer TU_TOKEN"
```

Respuesta esperada:

```json
{
  "current_page": 1,
  "data": [...],
  "last_page": 4,
  "per_page": 10,
  "total": 40
}
```

---

### 6. Cerrar sesión

```bash
curl -X POST http://127.0.0.1:8000/api/logout \
-H "Authorization: Bearer TU_TOKEN"
```

Respuesta esperada:

```json
{
  "message": "Sesión cerrada correctamente."
}
```

---

### 7. Verificar acceso sin autenticación

Después de cerrar sesión, intentar acceder nuevamente a un endpoint protegido:

```bash
curl -X GET "http://127.0.0.1:8000/api/cargos?page=1" \
-H "Authorization: Bearer TU_TOKEN"
```

Respuesta esperada:

```json
{
  "message": "Unauthenticated."
}
```

Lo anterior confirma que el token fue invalidado correctamente y que las rutas protegidas requieren autenticación mediante Laravel Sanctum.

## Resultado esperado

```text
PASS Tests\Unit\ExampleTest

PASS Tests\Feature\AuthTest
✓ login correcto
✓ login incorrecto
✓ logout

PASS Tests\Feature\CargoTest
✓ listar cargos
✓ crear cargo
✓ mostrar cargo
✓ cargo no existe
✓ actualizar cargo
✓ eliminar cargo

PASS Tests\Feature\EmpleadoTest
✓ listar empleados
✓ crear empleado
✓ empleado no existe
✓ actualizar empleado
✓ eliminar empleado

PASS Tests\Feature\FuncionCargoTest
✓ listar funciones
✓ crear funcion
✓ funcion no existe
✓ actualizar funcion
✓ eliminar funcion
```

Actualmente el proyecto cuenta con 21 pruebas exitosas verificando la autenticación y las operaciones CRUD de la API.

# Autor

 Sheila Karina Gomez Agamez, pertenecientev a la ficha 3066552 del programa Analisis y Desarrollo de Software

