<?php

class RolSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->truncate();

		DB::table('roles')->insert(array(
		    array('id' => 1, 'rol' => 'ADMIN'),
		    array('id' => 2, 'rol' => 'USER'),
		));
    }

}