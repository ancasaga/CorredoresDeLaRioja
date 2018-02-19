<?php
namespace App\CorredoresRiojaInfraestructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Repository\ICorredorRepository;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class InMemoryCorredorRepository implements ICorredorRepository{
    private $corredores;
    public function __construct() {
        $this ->corredores[] = new Corredor(1234," Angela" , "Casado", "ancasag@unirioja.es", "1234", "1234" , new \DateTime("1993-12-18"));
        $this ->corredores[] = new Corredor(1662596," Maria" , "Casado", "macasag@unirioja.es", "pepitoGrillo", "calle" , new \DateTime("1996-01-04"));
    }
    public function anadirCorredor(Corredor $corredor){
         $this ->corredores[] = new Corredor($corredor->getDni(),$corredor->getNombre(),$corredor->getApellidos(),$corredor->getEmail(),$corredor->getPassword(),$corredor->getDireccion(), $corredor->getFechaNacimiento());
    }
    public function actualizarCorredor(Corredor $corredor){
        foreach ($this->corredores as $key => $value) {
            if ($value->getId() == $corredor>getId()) {
                unset($this->corredores[$key]);
            }
        }
        $this ->corredores[] = $corredor;
    }
    public function eliminarCorredor(Corredor $corredor){
        foreach ($this->corredores as $key => $value) {
            if ($value->getId() == $corredor>getId()) {
                unset($this->corredores[$key]);
            }
        }
    }
    public function buscarCorredorById(String $dni): Corredor{
        foreach ($this->corredores as $key => $value) {
            if ($value->getDni() == $dni) {
                return($this->corredores[$key]);
            }
        }
    }
    public function listaCorredores():array{
        return $this->corredores;
    }
}
