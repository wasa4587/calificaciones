<?php

class RecursoSeeder extends Seeder {

    public function run()
    {
        DB::table('recursos')->truncate();

		DB::table('recursos')->insert(array(
		    array('id' => 1, 'recurso' => '/', 'method'=> 'GET'),
		    array('id' => 2, 'recurso' => 'users', 'method'=> 'GET'),
		    array('id' => 3, 'recurso' => 'users', 'method'=> 'POST'),
		    array('id' => 4, 'recurso' => 'users/create', 'method'=> 'GET'),
		    array('id' => 5, 'recurso' => 'users/edit', 'method'=> 'GET'),
		    array('id' => 6, 'recurso' => 'users/delete/*', 'method'=> 'GET'),
		    array('id' => 7, 'recurso' => 'users/update/*', 'method'=> 'PUT'),

		    //paginas dummie
		    array('id' => 8, 'recurso' => 'about', 'method'=> 'GET'),
		    array('id' => 9, 'recurso' => 'contact', 'method'=> 'GET'),


		));
    }

}