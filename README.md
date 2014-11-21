
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

#Editando el menu
Solamente soporta dos niveles
```
vim app/config/menu.php
```

#Permisos

Para crear permisos, creas un recurso que es una url por ejemplo

```
vim app/database/seeds/RecursoSeeder.php
...
	    array('id' => 1, 'recurso' => '/', 'method'=> 'GET'),
	    array('id' => 2, 'recurso' => 'users', 'method'=> 'GET'),
```
Users seria la url, ejemplo

```
http:://localhost:/users
```

Si se necesitan mas roles se pueden agregar aqui
```
vim app/database/seeds/RolSeeder.php
```

Y la relacion de que rol puede ver que recurso iria aqui
```
vim app/database/seeds/RolRecursoSeeder.php
```

por ultimo en el archivo de rutas
```
vim app/routes.php
```

lo que quieras que funcione con estas reglas las deberas meter dentro de este grupo
```
Route::group(array('before' => ['auth']), function() {
```



