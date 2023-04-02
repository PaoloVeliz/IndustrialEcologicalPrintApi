## Documentacion de api de reto 
Esta es la documentacion para poder usar y poder probar la API 

# Instalación
    1. se necesita tener php
    2. se necesita tener algun gestor de base de datos.
## comienzo de instalacion
1. clonar el repo en la computadora con el comando 
```
git clone [la direccion de este proyecto]
```
    
3. debemos dirigirnos a la archivo con el nombre **.env.example**, crear un archivo nuevo con el nombre **.env** y copiar el contenido dentro de este
   1. colocar las credenciales para de la base de datos en este nuevo archivo.
   ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3309
        DB_DATABASE=Laravel
        DB_USERNAME=root
        DB_PASSWORD=
   ```
    3. es importante recalcar que debemos crear una base de datos nueva para poder seguir para correr de forma segura los comandos al por venir
    4. colocar el siguiente comando
       ```
       php artisan migrate:refresh
        ```
    5. despues de colocar el comando, podemos inicar la api con el siguiente comando
       ```
        php artisan serve
        ```
## enlace para el entorno de trabajo de postman
  
[Pruebas y documentacion hechas en postman](https://elements.getpostman.com/redirect?entityId=16739836-a175fcb3-f9d0-450b-975b-f3d953b234b3&entityType=collection)


