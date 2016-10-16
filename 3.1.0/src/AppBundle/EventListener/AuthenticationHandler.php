<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\AgenturLogin;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, LogoutSuccessHandlerInterface, AuthenticationManagerInterface
{

	protected $router;
	protected $security;

	public function __construct(EntityManager $entityManager, RequestStack $request_stack, TokenStorage $tokenStorage)
	{
		$this->em = $entityManager;
		$this->tokenStorage = $tokenStorage;
		$this->request = $request_stack;
	}

	public function onAuthenticationSuccess(Request $request, TokenInterface $token)
	{
		$user   =   $this->tokenStorage->getToken()->getUser();

		$log = new AgenturLogin();

		$log->setAg($user);
		$log->setAgIp($this->request->getCurrentRequest()->getClientIp());
		$log->setAgSession($this->request->getCurrentRequest()->getSession()->getId());
		$log->setAgCreated( new \DateTime());

		$em = $this->em;
		$em->persist($log);
		$em->flush();

		if($request->getSession()->has('_security.vertrieb.target_path')){

			$referer_url = $request->getSession()->get('_security.vertrieb.target_path');

		} else {

			$referer_url = $request->headers->get('referer');

		}
		
		$response = new RedirectResponse($referer_url);

		return $response;
	}

	public function onLogoutSuccess(Request $request)
	{
		// redirect the user to where they were before the login process begun.
		$user   =   $this->tokenStorage->getToken()->getUser();

		$lastLog = $user->getAuLogs()->first();

		$date = new \DateTime();

		$date->setTimestamp($request->getSession()->getMetadataBag()->getLastUsed());

		$lastLog->setAgExpire($date);

		$em = $this->em;
		$em->persist($lastLog);
		$em->flush();

		$referer_url = $request->headers->get('referer');

		$response = new RedirectResponse($referer_url);

		return $response;
	}

	public function authenticate(TokenInterface $token)
	{
		// TODO: Implement authenticate() method.
	}


}