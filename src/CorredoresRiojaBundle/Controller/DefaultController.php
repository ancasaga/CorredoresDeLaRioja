<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use CorredoresRiojaBundle\Form\CorredorType;

class DefaultController extends Controller {

	public function showPortadaAction() {
		$carrerasNo = $this->get("carrerasrepository")->listaCarreraNoDisputadas();
		return $this->render("CorredoresRiojaBundle:Portada:portada.html.twig", array('carrerasNo' => $carrerasNo));
	}

	public function showCorredoresAction() {
		$corredores = $this->get("corredorrepository")->listaCorredores();
		return $this->render("CorredoresRiojaBundle:ZonaCorredores:zonacorredores.html.twig", array('corredores' => $corredores));
		//return new Response(implode("<br/>", $corredores));
	}

	public function showCarrerasAction() {
		$carrerasNo = $this->get("carrerasrepository")->listaCarreraNoDisputadas();
		$carrerasSi = $this->get("carrerasrepository")->listaCarreraDisputadas();
		return $this->render("CorredoresRiojaBundle:Carreras:carreras.html.twig", array('carrerasNo' => $carrerasNo, 'carrerasSi' => $carrerasSi));
	}

	public function showCarrerasSlugAction($slug) {

		$carrera = $this->get("carrerasrepository")->buscarCarreraBySlug($slug);
		if ($carrera != null) {
			$listParti = $this->get("participanterepository")->listaParticipantes($carrera);
			return $this->render("CorredoresRiojaBundle:Carrera:carrera.html.twig", array('carrera' => $carrera, 'listParti' => $listParti));
		} else {
			return new Response("There is no entry with id " . $slug);
		}
	}

	public function showOrganizacionSlugAction($slug) {
		$organizacion = $this->get("organizacionrepository")->buscarOrganizacionBySlug($slug);
		if ($organizacion != null) {
			$listaCarrerasDis = $this->get("carrerasrepository")->listaCarrerasOrganizacionDisputadas($organizacion);
			$listaCarrerasNoDis = $this->get("carrerasrepository")->listaCarrerasOrganizacionNoDisputadas($organizacion);
			return $this->render("CorredoresRiojaBundle:Organizacion:organizacion.html.twig", array('organizacion' => $organizacion, 'listaCarrerasDis' => $listaCarrerasDis, 'listaCarrerasNoDis' => $listaCarrerasNoDis));
		} else {
			return new Response("There is no entry with id " . $slug);
		}
	}

	public function registroAction(Request $peticion) {
		$form = $this->createForm(CorredorType::class);
		$form->handleRequest($peticion);
		if ($form->isValid()) {
			// Recogemos el corredor que se ha registrado
			$corredor = $form->getData();
			// Codificamos la contraseña del corredor
			$encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
			$password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
			$corredor->setPassword($password);
			// Lo almacenamos en nuestro repositorio de corredores
			$this->get('corredorrepository')->anadirCorredor($corredor);
			// Creamos un mensaje flash para mostrar al usuario que 
			// se ha registrado correctamente
			$this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getNombre() . ' te has registrado en CorredoresPorLaRioja!');
			// Reedirigimos al usuario a la portada
			return $this->redirect($this->generateUrl('corredores_de_la_rioja_corredores_de_la_rioja_portada'));
		}
		return $this->render("CorredoresRiojaBundle:ZonaCorredores:registro.html.twig", array('formulario' => $form->createView()));
	}

	/*public function loginAction(Request $peticion) {
		$form = $this->createForm(CorredorType::class);
		$form->handleRequest($peticion);
		if ($form->isValid()) {
			// Recogemos el corredor que se ha registrado
			$corredor = $form->getData();
			// Codificamos la contraseña del corredor
			$encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
			$password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
			$corredor->saveEncodedPassword($password);
			// Lo almacenamos en nuestro repositorio de corredores
			$this->get('corredoresrepository')->registraCorredor($corredor);
			// Creamos un mensaje flash para mostrar al usuario que 
			// se ha registrado correctamente
			$this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getName() . ' te has registrado en CorredoresPorLaRioja!');
			// Reedirigimos al usuario a la portada
			return $this->redirect($this->generateUrl('portada'));
		}
		return $this->render("CorredoresRiojaBundle:ZonaCorredores:registro.html.twig", array('formulario' => $form->createView()));
	}*/

	public function loginAction(Request $request) {
		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render(
				'CorredoresRiojaBundle:ZonaCorredores:login.html.twig', array(
			    // last username entered by the user
			    'last_username' => $lastUsername,
			    'error' => $error,
				)
		);
	}

	public function showPerfilAction() {
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}

		$user = $this->getUser();
		// the above is a shortcut for this
		$user = $this->get('security.token_storage')->getToken()->getUser();
                
                $corredor = $this->get("corredorrepository")->buscarCorredorById($user->getUsername());
                
                $form = $this->createForm(CorredorType::class,$corredor);
                return $this->render("CorredoresRiojaBundle:ZonaCorredores:perfil.html.twig", array('formulario' => $form->createView()));
	
	}
	public function showMisCarrerasAction() {
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}

		$user = $this->getUser();
		// the above is a shortcut for this
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$corredor = $this->get("corredorrepository")->buscarCorredorById($user->getUsername());
		$carrerasDisputadas = $this->get("participanterepository")->listaCarreraDisputadasCorredor($corredor);
		$carrerasNoDisputadas = $this->get("participanterepository")->listaCarreraNoDisputadasCorredor($corredor);
		return $this->render("CorredoresRiojaBundle:ZonaCorredores:miscarreras.html.twig", array('corredor' => $corredor, 'carrerasDisputadas' => $carrerasDisputadas, 'carrerasNoDisputadas' => $carrerasNoDisputadas));
	}

}
