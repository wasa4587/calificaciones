<?php

class RolRecursoSeeder extends Seeder {

    public function run()
    {
        DB::table('recursos_roles')->truncate();

        
        $i=1;
        //roles del admin
        $roles = [];
        for (;$i<=9;$i++) {
        	$roles[] = array('id' => $i, 'recurso_id' => $i, 'rol_id'=> 1);
        }
		DB::table('recursos_roles')->insert($roles);

		DB::table('recursos_roles')->insert(array(
		    array('id' => $i++, 'recurso_id' => 1, 'rol_id'=> 2),
		    array('id' => $i++, 'recurso_id' => 3, 'rol_id'=> 2),
		    array('id' => $i++, 'recurso_id' => 4, 'rol_id'=> 2),
		    //permisos a paginas dummie
		    array('id' => $i++, 'recurso_id' => 8, 'rol_id'=> 2),
		    array('id' => $i++, 'recurso_id' => 9, 'rol_id'=> 2),


		));
    }

}