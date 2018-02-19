<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CorredoresRiojaInfraestructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Repository\ICarreraRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;
/**
 * Description of InMemoryCarreraRepository
 *
 * @author Ángela
 */
class InMemoryCarreraRepository implements ICarreraRepository{
    //put your code here
    private $carreras;

    public function __construct() {
        $organi;
        $organi2;
        //($id, $nombre, $descripcion, $fechaCelebracion, $distancia, $fechaLimiteInscripcion, $numeroMaximoParticipantes, $imagen,$organizacion
        $organi = new Organizacion(1, "Dapi" , "Casado", "ancasag@unirioja.es", "pepitoGrillo");
        $organi2 = new Organizacion(1, "Matute" , "Casado", "ac@unirioja.es", "pepitoGrillo");
        $this ->carreras[] = new Carrera(2, "primeraCarreraDisp" , "primeracarreradelaño", new \DateTime("2016-10-17"), 10,new \DateTime("2016-10-15"),10,"anguiano.jpg", $organi);
        $this ->carreras[] = new Carrera(3, "SegundaCarreraNo" , "Segundacarreradelaño", new \DateTime("2017-11-17"), 10,new \DateTime("2017-11-15"),10,"anguiano.jpg", $organi);
        $this ->carreras[] = new Carrera(4, "terceraCarreraDispu" , "primeracarreradelaño", new \DateTime("2016-10-17"), 10,new \DateTime("2016-10-15"),10,"anguiano.jpg", $organi);
        $this ->carreras[] = new Carrera(5, "cuartaCarreraNo" , "Segundacarreradelaño", new \DateTime("2017-11-17"), 10,new \DateTime("2017-11-15"),10,"anguiano.jpg", $organi);
        $this ->carreras[] = new Carrera(6, "CarreraMatute" , "Segundacarreradelaño", new \DateTime("2017-11-17"), 10,new \DateTime("2017-11-15"),10,"matutrail.jpg", $organi2);
    }
    public function anadirCarrera(Carrera $carrera){
        $this ->carreras[] = new Carrera($carrera->getId(),$carrera->getNombre(),$carrera->getDescripcion(),$carrera->getFechaCelebracion(),$carrera->getDistancia(),$carrera->getFechaLimiteInscripcion(),$carrera->getNumeroMaximoParticipantes(),$carrera->getImagen(),$carrera->getOrganizacion());
    }
    public function actualizarCarrera(Carrera $carrera){
        foreach ($this->carreras as $key => $value) {
            if ($value->getId() == $carrera>getId()) {
                unset($this->carreras[$key]);
            }
        }
        $this ->carreras[] = $carrera;
    }
    public function eliminarCarrera(Carrera $carrera){
        foreach ($this->carreras as $key => $value) {
            if ($value->getId() == $carrera>getId()) {
                unset($this->carreras[$key]);
            }
        }
    }
    public function buscarCarreraBySlug(String $slug): Carrera{
        foreach ($this->carreras as $key => $value) {
            if (Carrera::getSlug2($value->getNombre()) == $slug) {
                return($this->carreras[$key]);
            }
        }
    }
    public function listaCarrerasOrganizacionDisputadas(Organizacion $organizacion): array{
        $lista=[];
        foreach ($this->carreras as $key => $value) {
            if (($value->getFechaCelebracion()->format("Y-m-d") < (new \Datetime("now"))->format("Y-m-d")) && ($value->getOrganizacion()->getNombre() == $organizacion->getNombre())) {
                $lista[]= $value;
            }
        }
        return($lista);
    }
    public function listaCarrerasOrganizacionNoDisputadas(Organizacion $organizacion): array{
        $lista=[];
        foreach ($this->carreras as $key => $value) {
            if (($value->getFechaCelebracion()->format("Y-m-d") >= (new \Datetime("now"))->format("Y-m-d")) && ($value->getOrganizacion()->getNombre() == $organizacion->getNombre())) {
                $lista[]= $value;
            }
        }
        return($lista);
    }
    public function listaCarrera():array{
        return $this->carreras;
    }
    public function listaCarreraDisputadas():array{
        $lista=[];
        foreach ($this->carreras as $key => $value) {
            if ($value->getFechaCelebracion()->format("Y-m-d") < (new \Datetime("now"))->format("Y-m-d")) {
                $lista[]= $value;
            }
        }
        return($lista);
    }
    public function listaCarreraNoDisputadas():array{
        $lista=[];
        foreach ($this->carreras as $key => $value) {
            if ($value->getFechaCelebracion()->format("Y-m-d")>=(new \Datetime("now"))->format("Y-m-d")) {
                $lista[]= $value;
            }
        }
        return($lista);
    }
}
