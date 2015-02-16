<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uek\DemoBundle\Entity\Wypozyczenia;
use Symfony\Component\HttpFoundation\Request;

class WypozyczeniaController extends Controller
{
	public function indexAction() 
	{
		
		if ($this->getUser() == null)
		{
			return $this->redirect($this->generateUrl('fos_user_security_login', array()));
			
		} else {
			
			$uzytkownik = $this->getUser()->getUsername();
			
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery(
				'SELECT f.tytulfilmu, f.oplata, w.idwypozyczenia, u.username FROM UekDemoBundle:Filmy f JOIN UekDemoBundle:Wypozyczenia w WHERE f.idfilmu = w.idfilmu JOIN UekDemoBundle:User u WHERE w.iduzytkownika = u.id'
			);

			$wypozyczenia = $query->getResult();
	
			return $this->render(
				'UekDemoBundle:Wypozyczenia:index.html.twig',
				array(
					'wypozyczenia' => $wypozyczenia
				
				)
			);
		}
	}
	
}