<?php

namespace CorredoresDeLaRioja\CorredoresDeLaRiojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $carreras = $this->get("carrerasrepository")->listaCarreraNoDisputadas();
        return new Response(implode("<br/>", $carreras));
    }
    public function showCarrerasAction()
    {
        $carreras = $this->get("carrerasrepository")->listaCarreraNoDisputadas();
        return new Response(implode("<br/>", $carreras));
    }
    public function showCarrerasSlugAction()
    {
        $carreras = $this->get("carrerasrepository")->buscarCarreraBySlug();
        return new Response(implode("<br/>", $carreras));
    }
    public function showOrganizacionSlugAction()
    {
        $organizacion = $this->get("organizacionrepository")->buscarOrganizacionBySlug();
        return new Response(implode("<br/>", $organizacion));
    }
}
