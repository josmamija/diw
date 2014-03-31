<?php
require_once 'Persona.php';
require_once 'Perro.php';
require_once 'Gato.php';
require_once 'Escuela.php';

class Index {
	public function ejecutar() {
		/* Micaela tiene un perro */
		$persona = new Persona ('Micaela',5);
		$perro = new Perro('Tito', 'blanco y negro');
		$persona->setPerro($perro);

		/* Martina, dueña del mismo perro... */
		$persona1= new Persona ('Martina',3);
		$persona1->setPerro($perro);
		$persona1->setGato(new Gato('Lluna','gris y blanco'));
		/* Marcos es dueño de un gato */
		$persona2= new Persona('Marcos',6);
		$persona2->setGato(new Gato('Lluna','gris y blanco'));

		/* Escuela Dos Corazones */
		$escuela = new Escuela('Dos corazones');

		/* ... Micaela va junto con 5 niños más ... */
		$escuela->addAlumno($persona);
		$escuela->addAlumno($persona1);
		$escuela->addAlumno($persona2);
		$escuela->addAlumno(new Persona('Julio',5));
		$escuela->addAlumno(new Persona('Martin',4));
		$escuela->addAlumno(new Persona('Carla',4));

		echo $escuela;
		
		echo '<br>';
		$p1 = $escuela->getAlumno(0);
		echo $p1 ;
		echo ' Da de comer al perro <br>';
		$p1->darComer($perro);
		echo $p1 .' Acaricia al perro <br>';
		$p1->tocar($perro);
		
		echo '<br>';
		$p2 = $escuela->getAlumno(1);
		$perro2 = $p2->getPerro();
		echo $p2 .' da de comer al perro <br>';
		$p2->darComer($perro2);
		echo $p2 . ' acaricia al perro <br>';
		$p2->tocar($perro2);
		$gato = $p2->getGato();
		echo $p2 .' da de comer al gato <br>';
		$p2->darComerG($gato);
		echo $p2 .' acaricia al gato <br>';
		$p2->tocarG($gato);
		
	}
}


Index::ejecutar();
