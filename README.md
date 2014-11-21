
# Instalar laravel
```
composer update
```

#Crear base de datos en mysql
```
create database calificaciones;
```

#configurar la conexion
```
vim app/config/database.php
```

#Crear bases de datos
```
php artisan migrate --seed
```

#Probar el sistema
```
php artisan serve
```
