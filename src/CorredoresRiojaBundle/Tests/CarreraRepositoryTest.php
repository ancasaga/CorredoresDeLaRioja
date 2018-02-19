<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Model\Carrera;
class CarreraRepositoryTest extends KernelTestCase {

	private $repository;
	private $container;

	protected function setUp() {
		self::bootKernel();
		$this->container = self::$kernel->getContainer();
		$this->repository = $this->container->get('carrerasrepository');
	}

	//test que comprueba que el conjunto de carreras incluye a las disputadas y a las no disputadas
	public function testCarrerasEsCarrerasDisputadasYNoDisputadas() {
		$carreras = $this->repository->listaCarrera();
		$carrerasNoDisputadas = $this->repository->listaCarreraNoDisputadas();
		$carrerasDisputadas = $this->repository->listaCarreraDisputadas();

		foreach ($carrerasDisputadas as $carrera) {
			$this->assertContains($carrera, $carreras);
		}
		foreach ($carrerasNoDisputadas as $carrera) {
			$this->assertContains($carrera, $carreras);
		}
	}

	
	//que comprueba que si añadimos una carrera a nuestro repositorio, dicha carrera pasa a estar disponible
	public function testAnadirCarrera() {
                        
		$org1 = new Organizacion(1,"Ayuntamiento Matute", "El ayuntamiento de matute", "matute@gmail.com", "matute");
		$carrera = new Carrera(3, "Carrera Montes Anguiano", "Primera carrera por los montes de Anguiano", new \DateTime("2015-06-15"), "10 km", new \DateTime("2015-06-14"), 50, "anguiano.jpg", $org1);
		$this->repository->anadirCarrera($carrera);

		$this->assertNotNull($this->repository->buscarCarreraBySlug('carrera-montes-anguiano'));
	}

	
	//se encarga de que todas las carreras por disputar tienen una fecha posterior a la actual
	public function testCarrerasPorDisputar() {
		$carrerasNoDisputadas = $this->repository->listaCarreraNoDisputadas();
		foreach ($carrerasNoDisputadas as $carrera) {
			$this->assertTrue($carrera->getFechacelebracion()->format("Y-m-d") > (new \DateTime('now'))->format("Y-m-d"));
		}
	}

	//test que compruebe que si eliminamos una carrera de la aplicación, dicha carrera deja de estar disponible

	//test que compruebe que todas las carreras de la lista devuelta por el método que busca las carreras disputadas tienen una fecha de celebración anterior a la actua
}
