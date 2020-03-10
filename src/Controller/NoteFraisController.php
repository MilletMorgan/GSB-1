<?php


namespace App\Controller;

use App\Entity\NoteFrais;
use App\Entity\User;
use App\Form\NoteFraisType;
use App\Repository\NoteFraisRepository;
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

	/**
	 * @Route("/editNoteFrais/{id}", name="editNoteFrais")
	 * @param $id
	 * @param NoteFraisRepository $noteFraisRepository
	 * @param Request $request
	 * @return RedirectResponse|Response
	 */
	public function edit($id, NoteFraisRepository $noteFraisRepository, Request $request)
	{
		$noteFrais = $noteFraisRepository->find($id);
		$form = $this->createForm(NoteFraisType::class, $noteFrais);

		if (!$noteFrais)
		{
			throw $this->createNotFoundException(
				'Note de frais introuvable pour '.$id
			);
		}

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) 
		{
			$noteFrais = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($noteFrais);
			$entityManager->flush();
			return $this->redirectToRoute('app_login');
		}

		return $this->render('notefrais/notefrais_edit.html.twig', ['form'=>$form->createView()]);
	}
	
	/**
	 * @Route("/showNoteFrais/{id}", name="showNoteFrais")
	 * @param $id
	 */
	public function show($id)
	{
		$noteFrais = $this->getDoctrine()->getRepository(NoteFrais::class)->find($id);

		if (!$noteFrais)
		{
			throw $this->createNotFoundException(
				'Note de frais introuvable pour '.$id
			);
		}
		return $this->render('notefrais/notefrais_show.html.twig',['noteFrais'=>$noteFrais]);
	}
		/**
	 * @Route("/deleteNoteFrais/{id}", name="deleteNoteFrais")
	 * @param $id
	 */
	public function delete($id)
	{
		$noteFrais = $this->getDoctrine()->getRepository(NoteFrais::class)->find($id);

		if (!$noteFrais)
		{
			throw $this->createNotFoundException(
				'Note de frais introuvable pour '.$id
			);
		}
		$entityManager->remove($noteFrais);
		$entityManager->flush();

		return $this->redirectToRoute('app_login');
	}
}