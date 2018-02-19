<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Organizacion;
/**
 *
 * @author master
 */
interface IOrganizacionRepository {
    //put your code here
    public function anadirOrganizacion(Organizacion $organizacion);
    public function actualizarOrganizacion(Organizacion $organizacion);
    public function eliminarOrganizacion(Organizacion $organizacion);
    public function buscarOrganizacionBySlug(String $slug): Organizacion;
    public function buscarOrganizacionByEmail(String $email): Organizacion;
    public function listaCorredores():array;
}
