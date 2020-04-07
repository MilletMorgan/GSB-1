<?php


namespace App\Controller;


use App\Entity\Etat;
use App\Entity\Fiche;
use App\Entity\LigneHf;
use App\Entity\User;
use App\Form\LigneHfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Psr\Log\LoggerInterface;

class LigneHfController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/lignehf", name="lignehf")
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function new(Request $request)
    {
        $lignehf = new LigneHf();

        $form = $this->createForm(LigneHfType::class, $lignehf);
        $form->handleRequest($request);

        $ficheRepository = $this->getDoctrine()->getRepository(Fiche::class);
        $fiche = $ficheRepository->findOneBy([
            'mois' => date('m'),
            'annee' => date('Y'),
        ]);

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($this->getUser()->getId());

        $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy([
            'ordre' => 1
        ]);

        $entityManager = $this->getDoctrine()->getManager();


        if ($form->isSubmitted() && $form->isValid()) {
            $date_frais = $form->get('dateFrais')->getData()->format('Y-m-d');;

            if ($date_frais <= date("Y-m-d") and strtotime($date_frais) >= (strtotime(date('Y-m-d') . "-365 days"))) {
                $this->addFlash(
                    'success',
                    "La note de frais à bien été ajoutée !"
                );

                if ($fiche) {
                    $lignehf->setFiche($fiche);
                    $lignehf->setFiche($fiche);
                    $lignehf->setEtat($etat);
                } else {
                    $newFiche = new Fiche();

                    $newFiche->setEtat($etat);
                    $newFiche->setUser($user);
                    $newFiche->setMois(date('m'));
                    $newFiche->setAnnee(date('Y'));

                    $entityManager->persist($newFiche);
                    $entityManager->flush();
                }

                $entityManager->persist($lignehf);
                $entityManager->flush();
            } else {
                $this->addFlash(
                    'error',
                    "La date ne peut pas être supérieur à la date d'aujourd'hui !"
                );
//                throw new \Exception("error : " , dump($date_frais));
            }

            return $this->render('fiche/lignehf_new.html.twig', array('form' => $form->createView()));
        }

        return $this->render('fiche/lignehf_new.html.twig', array('form' => $form->createView()));
    }
}