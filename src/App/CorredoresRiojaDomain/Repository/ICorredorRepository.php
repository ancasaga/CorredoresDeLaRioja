<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Corredor;
/**
 *
 * @author master
 */
interface ICorredorRepository {
    //put your code here
    public function anadirCorredor(Corredor $corredor);
    public function actualizarCorredor(Corredor $corredor);
    public function eliminarCorredor(Corredor $corredor);
    public function buscarCorredorById(String $dni): Corredor;
    public function listaCorredores():array;
}
