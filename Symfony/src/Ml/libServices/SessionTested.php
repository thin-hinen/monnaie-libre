<?php

namespace Ml\libServices;

class SessionTested{
	/*
	Vérifie si l'utilisateur en cours a sa session activée.
	Si elle ne l'est pas, une exception indiquant que l'utilisateur ne possède pas de session en cours en généré.
	*/


	/* Verifie si le login existe dans la session.Si oui renvoi du login, sinon appel de l'exception */
	public function sessionExist($req){
		// On récupère la requête
		$session = $req->getSession();		
		$login = $session->get('login');

		/* Si on est pas logger -> redirection vers la page d'inscription */
		if ($login == NULL) {
			throw new \Exception("Sorry, you're not logged yet...");
		}
		
		return $login;

	}
}
