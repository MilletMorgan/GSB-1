<?php


namespace App\Controller;


use App\Entity\LigneHf;
use App\Form\LigneHfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LigneHfController extends AbstractController
{
	/**
	 * @Route("/lignehf", name="lignehf")
	 * @param Request $request
	 * @return RedirectResponse|Response
	 */
	public function new(Request $request)
	{
		$lignehf = new LigneHf();

		$form = $this->createForm(LigneHfType::class, $lignehf);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($lignehf);
			$entityManager->flush();

			return $this->redirectToRoute('app_login');
		}

		return $this->render('fiche/lignehf_new.html.twig', array('form' => $form->createView()));
	}
}