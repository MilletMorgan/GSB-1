<?php

namespace App\Controller;

use App\Entity\FicheFrais;
use App\Form\FicheFraisType;
use App\Repository\FicheFraisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    /**
     * @Route("/editFicheFrais/{id}", name="editFicheFrais")
     * @param $id
     * @param FicheFraisRepository $ficheFraisRepository
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit($id, FicheFraisRepository $ficheFraisRepository, Request $request)
    {
        $ficheFrais = $ficheFraisRepository->find($id);
        $form = $this->createForm(FicheFraisType::class, $ficheFrais);

        if (!$ficheFrais)
        {
            throw $this->createNotFoundException(
                'Fiche de frais introuvable pour '.$id
            );
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $ficheFrais = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ficheFrais);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('fichefrais/fichefrais_edit.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/showFicheFrais/{id}", name="showFicheFrais")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $ficheFrais = $this->getDoctrine()->getRepository(FicheFrais::class)->find($id);

        if (!$ficheFrais)
        {
            throw $this->createNotFoundException(
                'Fiche de frais introuvable pour '.$id
            );
        }
        return $this->render('fichefrais/fichefrais_show.html.twig',['ficheFrais'=>$ficheFrais]);
    }

    /**
     * @Route("/deleteFicheFrais/{id}", name="deleteFicheFrais")
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $ficheFrais = $this->getDoctrine()->getRepository(FicheFrais::class)->find($id);

        if (!$ficheFrais)
        {
            throw $this->createNotFoundException(
                'Fiche de frais introuvable pour '.$id
            );
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ficheFrais);
        $entityManager->flush();

}