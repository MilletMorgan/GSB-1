<?php


namespace App\Controller;


use App\Entity\Etat;
use App\Entity\Fiche;
use App\Entity\LigneFf;
use App\Entity\LigneHf;
use App\Entity\TypeFF;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\TypeFFType;
use App\Form\VehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FicheController
 * @package App\Controller
 * @Route("/comptable")
 */
class ComptableController extends AbstractController
{

    /**
     * @Route("/new-type", name="new-type")
     * @param Request $request
     * @return Response
     */
    public function newType(Request $request)
    {
        $type = new TypeFF();

        $form = $this->createForm(TypeFFType::class, $type);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($type);
            $entityManager->flush();

            return $this->redirectToRoute('showAllFichesComptable');
        }

        return $this->render('comptable/type_new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/show-all-fiches", name="showAllFichesComptable")
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

        return $this->render('comptable/fichefrais_show_all.html.twig', [
            'ligneFfs' => $ligneFf,
            'ligneHfs' => $ligneHf
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

        return $this->redirectToRoute('showAllFichesComptable');
    }

    /**
     * @Route("/etat/{id}/{etat}", name="etatFicheFrais")
     * @param $id
     * @param $etat
     * @return Response
     */
    public function etatFicheFrais($id, $etat)
    {
        $entityManager = $this->getDoctrine()->getManager();

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

        $newEtat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy([
            'id' => $etat
        ]);

        $ficheFrais->setEtat($newEtat);

        $entityManager->flush();

        $this->addFlash(
            'success',
            "L'état de la note de frais à bien été modifier"
        );

        return $this->redirectToRoute('showAllFichesComptable');
    }

    /**
     * @Route("/add-vehicule", name="addVehicule")
     * @param Request $request
     * @return Response
     */
    public function addVehicule(Request $request)
    {
        $vehicule = new Vehicule();

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(VehiculeType::class, $vehicule);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($vehicule);
            $entityManager->flush();

            return $this->redirectToRoute('showAllFichesComptable');
        }

        return $this->render('comptable/vehicule_new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/show-vehicule-affecter", name="show-vehicule-affecter")
     * @return Response
     */
    public function showVehiculeAffecter()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $repository = $this->getDoctrine()->getRepository(Vehicule::class);

        $vehicules = $repository->findBy([
            'utilisateur' => $user
        ]);

        return $this->render('comptable/vehicule_show_all.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }
}