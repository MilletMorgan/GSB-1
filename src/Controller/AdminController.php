<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/adminListe", name="admin1")
     */
    public function admin1(){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $User = $repository->findAll();
        return $this->render('admin/liste.html.twig', array(
            'Users' => $User
        ));

    }
}
