<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\CorredoresRiojaDomain\Model;
/**
 * Description of Participante
 *
 * @author master
 */
class Participante {
    //put your code here
    private $corredor;
    private $carrera;
    private $dorsal;
    private $tiempo;
    function __construct($corredor, $carrera,$dorsal,$tiempo) {
        $this->corredor = $corredor;
        $this->carrera = $carrera;
	$this->dorsal= $dorsal;
	$this -> tiempo = $tiempo;
    }
    function getCorredor() {
        return $this->corredor;
    }

    function getCarrera() {
        return $this->carrera;
    }

    function getDorsal() {
        return $this->dorsal;
    }

    function getTiempo() {
        return $this->tiempo;
    }
    public function asignarMarca($tiempo)
    {
        $this->tiempo = $tiempo;
    }
    
    public function __toString() {
          return  ". Corredor: " . $this->corredor." Carrera: " . 
                  $this->carrera . ". dorsal: " . $this->dorsal." tiempo: " 
                  . $this->tiempo."<br/>";
    }


}
