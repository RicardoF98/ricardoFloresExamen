
Backend de Gestión de Productos
Este proyecto es una API de backend para gestionar productos con funcionalidades de CRUD (Crear, Leer, Actualizar, Eliminar) y operaciones en batch. Utiliza Laravel como framework y Laravel Sanctum para autenticación.
Requisitos

    PHP >= 8.0
    Composer
    Laravel 8
    MySQL 

    1.- Clonar repositorio:
    git clone https://github.com/RicardoF98/ricardoFloresExamen.git

    2.- Instalar dependencias PHP:
    composer install

    3.- Configurar archivo .env
    Usar archivo .env.example para crear archivo .env y configurar la base de datos creada previamente en MYSQL (CREATE DATABASE nombre_de_base_de_datos;).

    4.-Generar clave de aplicación:
    php artisan key:generate en la linea de comandos (CMD/Terminal) dentro de la ruta del proyecto.

    5.-Ejecutar las migraciones para creacion de tablas en la base de datos previamente configurada en el .env:
    php artisan migrate

    6.- Ejecutar seeder de usuario creado para test (se puede omitir ya que hay un apartado para registrar usuarios).

    php artisan db: seed y generara el siguiente usuario
    name:API TEST
    phone:123456789
    password:123456789

   7.- Ejecutar el servidor de desarrollo:
   php artisan serve o php artisan serve --port=8080 <- este solo si se requiere ejecutar en un puerto específico.
  
   8.-Registro de Usuario
    Endpoint: POST http://localhost:8000/api/register
    Ejemplo de datos en body(RAW JSON) probando desde Postman.
    {
    "name": "Ricardo Flores",
    "email": "ricardo@example.com",
    "password": "password123",
    "phone": "1234567890",
    "img_profile": "https://example.com/profile.jpg"
    }
   9.- Inicio de Sesión:
   Endpoint: POST http://localhost:8000/api/login
   Ejemplo de datos en body(RAW JSON) probado desde postman
   {
    "phone": "1234567890",
    "password": "password123"
   } 

   10.- Agregar producto:
       Endpoint: POST http://localhost:8000/api/products
         Authorization Bearer Token 'YOURTOKEN'
         Content-Type: application/json
       Ejemplo de datos en body(RAW JSON) probado desde postman
      {
       "name": "Nuevo Producto",
       "description": "Descripción del nuevo producto",
       "height": 10,
       "length": 20,
       "width": 30
      }

    11.- Consultar producto
       Endpoint: GET http://localhost:8000/api/products
         Authorization Bearer Token 'YOURTOKEN'
         Content-Type: application/json

    12.- Actualizar producto
        Endpoint: PUT http://localhost:8000/api/products/{id}
          Authorization Bearer Token 'YOURTOKEN'
          Content-Type: application/json
        Ejemplo de datos en body(RAW JSON) probado desde postman
      {
          "name": "Producto Actualizado",
          "description": "Descripción actualizada",
          "height": 15,
          "length": 25,
          "width": 20
      }
    13.- Eliminar Producto
    Endpoint: DELETE http://localhost:8000/api/products/{id}
    Authorization Bearer Token 'YOURTOKEN'
    Content-Type: application/json 

    14.- Agregar productos en Batch
    ENDPOINT: POST http://localhost:8000/api/product/batch
    Authorization Bearer Token 'YOURTOKEN'
    Content-Type: application/json
     Ejemplo de datos en body(RAW JSON) probado desde postman:
      [
          {
              "name": "Added Product Batch",
              "description": "Added description",
              "height": 18,
              "length": 28,
              "width": 38
          },
          {
              "name": "Added Product Batch",
              "description": "Added description",
              "height": 22,
              "length": 32,
              "width": 42
          }
      ]
    
    15.- Actualizar productos en batch.
    ENDPOINT: PUT http://localhost:8000/api/product/batch
    Authorization Bearer Token 'YOURTOKEN'
    Content-Type: application/json
     Ejemplo de datos en body(RAW JSON) probado desde postman:
     [
    {
        "id": 7,
        "name": "Updated Product 7",
        "description": "Updated description",
        "height": 18,
        "length": 28,
        "width": 38
    },
    {
        "id": 8,
        "name": "Updated Product 8",
        "description": "Updated description",
        "height": 22,
        "length": 32,
        "width": 42
    }
]

16.- Eliminar Producto en Batch  
  ENDPOINT: DELETE http://localhost:8000/api/product/batch
    Authorization Bearer Token 'YOURTOKEN'
    Content-Type: application/json
     Ejemplo de datos en body(RAW JSON) probado desde postman:
{
   "ids":[7,8]
}
