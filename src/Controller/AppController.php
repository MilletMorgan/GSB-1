<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
	/**
	 * @Route("/", name="app_homepage")
	 */
	public function index()
	{
		return $this->redirectToRoute('app_login');
	}
}