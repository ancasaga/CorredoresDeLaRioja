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
class Carrera {
    //put your code here
    private $id;
    private $nombre;
    private $descripcion;
    private $fechaCelebracion;
    private $distancia;
    private $fechaLimiteInscripcion;
    private $numeroMaximoParticipantes;
    private $imagen;
    private $slug;
    private $organizacion;
    function __construct($id, $nombre, $descripcion, $fechaCelebracion, $distancia, $fechaLimiteInscripcion, $numeroMaximoParticipantes, $imagen,$organizacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaCelebracion = $fechaCelebracion;
        $this->distancia = $distancia;
        $this->fechaLimiteInscripcion = $fechaLimiteInscripcion;
        $this->numeroMaximoParticipantes = $numeroMaximoParticipantes;
        $this->imagen = $imagen;
        $this->organizacion = $organizacion;
        $this->slug= Carrera::getSlug2($nombre);
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechaCelebracion() {
        return $this->fechaCelebracion;
    }

    function getDistancia() {
        return $this->distancia;
    }

    function getFechaLimiteInscripcion() {
        return $this->fechaLimiteInscripcion;
    }

    function getNumeroMaximoParticipantes() {
        return $this->numeroMaximoParticipantes;
    }

    function getImagen() {
        return $this->imagen;
    }
    
    function getOrganizacion() {
        return $this->organizacion;
    }
    function getSlug() {
        return $this->slug;
    }
    static public function getSlug2($cadena, $separador = '-'){
        // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, $separador));
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
        return $slug;
    }
    public function __toString() {
          return "Id: " . $this->id . 
                  " Nombre: " . $this->nombre." Descripción: " . 
                  $this->descripcion ."FechaCelebración: " . $this->fechaCelebracion->format("Y-m-d") . 
                  ". Distancia: " . $this->distancia . ". FechaLimiteInscripcion: " . $this->fechaLimiteInscripcion->format("Y-m-d")
                  .". NumeroMaximoParticipantes: " . $this->numeroMaximoParticipantes
                  . ". imagen: " . $this->imagen. "<br/>";
          #"FechaCelebración: " . $this->fechaCelebracion .. ". FechaLimiteInscripcion: " . $this->fechaLimiteInscripcion
    }
}

