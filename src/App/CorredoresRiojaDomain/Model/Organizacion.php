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
class Organizacion {
    //put your code here
    private $id;
    private $nombre;
    private $descripcion;
    private $email;
    private $password;
    private $salt;
    private $slug;
    
    function __construct($id, $nombre, $descripcion, $email, $password) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->email = $email;
        $this->password = $password;
        $this->salt = "";
        $this->slug= Organizacion::getSlug2($nombre);
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

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getSalt() {
        return $this->salt;
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
          return " Id: " . $this->id . 
                  ". Nombre: " . $this->nombre." Descripción: " . 
                  $this->descripcion . ". email: " . $this->email."<br/>";
    }

}