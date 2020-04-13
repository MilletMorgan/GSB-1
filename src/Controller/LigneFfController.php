<?php


namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Fiche;
use App\Entity\User;
use App\Form\LigneFfType;
use App\Entity\LigneFf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LigneFfController
 * @package App\Controller
 * @Route("/visiteur")
 */
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

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($this->getUser()->getId());

        $ficheRepository = $this->getDoctrine()->getRepository(Fiche::class);
        $fiche = $ficheRepository->findOneBy([
            'mois' => date('m'),
            'annee' => date('Y'),
            'user' => $user
        ]);

        $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy([
            'id' => 1
        ]);

        $entityManager = $this->getDoctrine()->getManager();


        if ($form->isSubmitted() && $form->isValid()) {
            $date_frais = $form->get('dateFFrais')->getData()->format('Y-m-d');

            if ($date_frais <= date("Y-m-d") and strtotime($date_frais) >= (strtotime(date('Y-m-d') . "-365 days"))) {
                $this->addFlash(
                    'success',
                    "La note de frais à bien été ajoutée !"
                );

                if ($fiche) {
                    $ligneff->setFiche($fiche);
                    $ligneff->setEtat($etat);
                } else {
                    $newFiche = new Fiche();

                    $newFiche->setEtat($etat);
                    $newFiche->setUser($user);
                    $newFiche->setMois(date('m'));
                    $newFiche->setAnnee(date('Y'));

                    $ligneff->setFiche($newFiche);
                    $ligneff->setEtat($etat);

                    $entityManager->persist($newFiche);
                    $entityManager->flush();
                }

                $entityManager->persist($ligneff);
                $entityManager->flush();
            } else {
                $this->addFlash(
                    'error',
                    "La date ne peut pas être supérieur à la date d'aujourd'hui !"
                );
//                throw new \Exception("error : " , dump($date_frais));
            }

            return $this->render('fiche/ligneff_new.html.twig', array('form' => $form->createView()));
        }

        return $this->render('fiche/ligneff_new.html.twig', array('form' => $form->createView()));
    }
}