<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CorredoresRiojaBundle\Security;

use CorredoresRiojaBundle\Security\CorredorUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\CorredoresRiojaDomain\Repository\ICorredorRepository;

/**
 * Description of CorredorUserProvider
 *
 * @author alumno
 */
class CorredorUserProvider implements UserProviderInterface {

	private $corredoresrepository;

	public function __construct(ICorredorRepository $repository) {
// Inyectamos el repositorio
		$this->corredoresrepository = $repository;
	}

	public function loadUserByUsername($username) {
// buscamos el usuario
		$userData = $this->corredoresrepository->buscarCorredorById($username);
// si existe el corredor, devolvemos un CorredorUser de 
// lo contrario devolvemos una excepción
		if ($userData) {
			$password = $userData->getPassword();
			$salt = $userData->getSalt();
			return new CorredorUser($username, $password, $salt);
		}

		throw new UsernameNotFoundException(
		sprintf('No existe un usuario con DNI "%s".', $username)
		);
	}

// La definición de estas dos funciones es casi siempre la misma
	public function refreshUser(UserInterface $user) {
		if (!$user instanceof CorredorUser) {
			throw new UnsupportedUserException(
			sprintf('Instances of "%s" are not supported.', get_class($user))
			);
		}

		return $this->loadUserByUsername($user->getUsername());
	}

	public function supportsClass($class) {
		return $class === 'CorredoresRiojaBundle\Security\CorredorUser';
	}

}
