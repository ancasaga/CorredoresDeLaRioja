<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CorredoresRiojaInfraestructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;
/**
 * Description of InMemoryOrganizacionRepository
 *
 * @author Ángela
 */
class InMemoryOrganizacionRepository implements IOrganizacionRepository{
    //put your code here
    private $organizaciones;
    public function __construct() {
        //($id, $nombre, $descripcion, $email, $password)
        $this ->organizaciones[] = new Organizacion(1662598, "Dapi" , "Casado", "ancasag@unirioja.es", "pepitoGrillo");
        $this ->organizaciones[] = new Organizacion(1, "Matute" , "Casado", "ac@unirioja.es", "pepitoGrillo");
    }
    public function anadirOrganizacion(Organizacion $organizacion){
         $this ->organizaciones[] = new Corredor($organizacion>getId(),$organizacion>getNombre(),$organizacion>getApellidos(),$organizacion>getEmail(),$organizacion>getPassword());
    }
    public function actualizarOrganizacion(Organizacion $organizacion){
        foreach ($this->organzaciones as $key => $value) {
            if ($value->getId() == $organizacion>getId()) {
                unset($this->organizaciones[$key]);
            }
        }
        $this ->organizaciones[] = $organizacion;
    }
    public function eliminarOrganizacion(Organizacion $organizacion){
        foreach ($this->organizaciones as $key => $value) {
            if ($value->getId() == $organizacion>getId()) {
                unset($this->organizaciones[$key]);
            }
        }
    }
    public function buscarOrganizacionBySlug(String $slug): Organizacion{
        foreach ($this->organizaciones as $key => $value) {
            if (Organizacion::getSlug2($value->getNombre()) == $slug) {
                return($this->organizaciones[$key]);
            }
        }
    }
    public function buscarOrganizacionByEmail(String $email): Organizacion{
        foreach ($this->organizaciones as $key => $value) {
            if ($value->getEmail() == $email) {
                return($this->organizaciones[$key]);
            }
        }
    }
    public function listaCorredores():array{
        return $this->organizaciones;
    }
}
