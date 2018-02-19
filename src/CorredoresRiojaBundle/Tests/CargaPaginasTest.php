<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\CorredoresRiojaBundle\Tests;  
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/**
 * Description of CargaPaginasTest
 *
 * @author master
 */
class CargaPaginasTest extends WebTestCase{
    //put your code here
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/es/portada'),
            array('/es/corredores/carreras'),
            array('/es/corredores/carrera/segundacarrerano'),
            array('/es/corredores/organizacion/dapi'),
            array('/es/corredores/login'),
            array('/es/corredores/registro'),
            array('/es/corredores'),
        );
    }

}
