<?php


namespace App\Controller;

use App\Entity\NoteFrais;
use App\Entity\User;
use App\Form\NoteFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class NoteFraisController extends AbstractController
{
	/**
	 * @Route("/notefrais", name="notefrais")
	 * @param Request $request
	 * @return RedirectResponse|Response
	 */
	public function new(Request $request)
	{
		$noteFrais = new NoteFrais();

		$form = $this->createForm(NoteFraisType::class, $noteFrais);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			/** @var User $user */
			$user = $this->getUser();
			$noteFrais->setUserId(intval($user->getId()));
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($noteFrais);
			$entityManager->flush();

			return $this->redirectToRoute('app_login');
		}

		return $this->render('notefrais/notefrais_new.html.twig', array('form' => $form->createView()));
	}
}