<?php


namespace App\Controller;

use App\Form\LigneFfType;
use App\Entity\LigneFf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LigneFfController extends AbstractController
{
	/**
	 * @Route("/ligneff", name="ligneff")
	 * @param Request $request
	 * @return RedirectResponse|Response
	 */
	public function new(Request $request)
	{
		$ligneff = new LigneFf();

		$form = $this->createForm(LigneFfType::class, $ligneff);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($ligneff);
			$entityManager->flush();

			return $this->redirectToRoute('app_login');
		}

		return $this->render('fiche/ligneff_new.html.twig', array('form' => $form->createView()));
	}
}