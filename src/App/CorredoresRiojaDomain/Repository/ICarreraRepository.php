<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;
/**
 *
 * @author master
 */
interface ICarreraRepository {
    //put your code here
    public function anadirCarrera(Carrera $carrera);
    public function actualizarCarrera(Carrera $carrera);
    public function eliminarCarrera(Carrera $carrera);
    public function buscarCarreraBySlug(String $slug): Carrera;
    public function listaCarrerasOrganizacionDisputadas(Organizacion $organizacion): array;
    public function listaCarrerasOrganizacionNoDisputadas(Organizacion $organizacion): array;
    public function listaCarrera():array;
    public function listaCarreraDisputadas():array;
    public function listaCarreraNoDisputadas():array;
}
