<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Participante;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Corredor;
/**
 *
 * @author master
 */
interface IParticipanteRepository {
    //put your code here
    public function anadirParticipante(Corredor $corredor, Carrera $carrera);
   
    public function listaParticipantes(Carrera $carrera):array;
    public function listaCarreraDisputadasCorredor(Corredor $corredor):array;
    public function listaCarreraNoDisputadasCorredor(Corredor $corredor):array;
    public function comprobarParticipanteCarrera(Corredor $corredor, Carrera $carrera): bool;
    public function actualizarTiempoParticipante(float $tiempo,Corredor $corredor);
    public function eliminarParticipante(Participante $participante);
}

