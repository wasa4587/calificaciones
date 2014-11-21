<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

   	    $this->call('RecursoSeeder');
   	    $this->call('RolRecursoSeeder');
   	    $this->call('RolSeeder');
	}

}
