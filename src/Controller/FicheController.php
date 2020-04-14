<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Entity\LigneFf;
use App\Entity\LigneHf;
use App\Entity\User;
use App\Form\FicheFraisType;
use App\Repository\FicheFraisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FicheController
 * @package App\Controller
 * @Route("/visiteur")
 */
class FicheController extends AbstractController
{
    /**
     * @Route("/edit/{id}", name="editFicheFrais")
     * @param $id
     * @param FicheFraisRepository $ficheFraisRepository
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit($id, FicheFraisRepository $ficheFraisRepository, Request $request)
    {
        $ligneFf = $this->getDoctrine()->getRepository(LigneFf::class)->find($id);
        $ligneHf = $this->getDoctrine()->getRepository(LigneHf::class)->find($id);

        if ($ligneHf && !$ligneFf) {
            $form = $this->createForm(FicheFraisType::class, $ligneHf);
        } elseif (!$ligneHf && $ligneFf) {
            $form = $this->createForm(FicheFraisType::class, $ligneFf);
        } else {
            throw $this->createNotFoundException(
                'Fiche de frais introuvable pour ' . $id
            );
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheFrais = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ficheFrais);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('fichefrais/fichefrais_edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/show/{id}", name="showFicheFrais")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $ligneFf = $this->getDoctrine()->getRepository(LigneFf::class)->find($id);
        $ligneHf = $this->getDoctrine()->getRepository(LigneHf::class)->find($id);

        if ($ligneHf && !$ligneFf) {
            return $this->render('fichefrais/fichefrais_show.html.twig', ['ficheFrais' => $ligneHf]);
        } elseif (!$ligneHf && $ligneFf) {
            return $this->render('fichefrais/fichefrais_show.html.twig', ['ficheFrais' => $ligneFf]);
        } else {
            throw $this->createNotFoundException(
                'Fiche de frais introuvable pour ' . $id
            );
        }
    }

    /**
     * @Route("/show-all-fiches", name="showAllFiches")
     */
    public function showAll()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($this->getUser()->getId());

        $ficheRepository = $this->getDoctrine()->getRepository(Fiche::class);

        $fiches = $ficheRepository->findBy([
            'user' => $user
        ]);

        $ligneFfRepository = $this->getDoctrine()->getRepository(LigneFf::class);
        $ligneHfRepository = $this->getDoctrine()->getRepository(LigneHf::class);


        $ligneFf = $ligneFfRepository->findBy([
            'fiche' => $fiches,
        ]);

        $ligneHf = $ligneHfRepository->findBy([
            'fiche' => $fiches
        ]);

        return $this->render('fichefrais/fichefrais_show_all.html.twig', [
            'ligneFfs' => $ligneFf,
            'ligneHfs' => $ligneHf,
            'fiches' => $fiches,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="deleteFicheFrais")
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $ligneFf = $this->getDoctrine()->getRepository(LigneFf::class)->find($id);
        $ligneHf = $this->getDoctrine()->getRepository(LigneHf::class)->find($id);

        if ($ligneHf && !$ligneFf) {
            $ficheFrais = $this->getDoctrine()->getRepository(LigneHf::class)->find($id);
        } elseif (!$ligneHf && $ligneFf) {
            $ficheFrais = $this->getDoctrine()->getRepository(LigneFf::class)->find($id);
        } else {
            throw $this->createNotFoundException(
                'Fiche de frais introuvable pour ' . $id
            );
        }

        $this->addFlash(
            'success',
            "La note de frais à bien été supprimé !"
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ficheFrais);
        $entityManager->flush();

        return $this->redirectToRoute('showAllFiches');

    }
}