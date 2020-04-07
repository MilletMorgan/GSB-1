<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;


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

    /**
     * @Route("/user/{userId}", name="editUser")
     * @param $id
     * @param Request $request
     */
    public function edit($userId, UserRepository $userRepository, Request $request)
    {
        $User = $userRepository->find($userId);
        $form = $this->createForm(UserType::class, $User);

        if (!$User)
        {
            throw $this->createNotFoundException(
                'Utilisateur introuvable pour '.$userId
            );
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $User = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($User);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('admin/edit.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/supprUser/{id}", name="deleteUser")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $User = $entityManager->getRepository(User::class)->find($id);

        $entityManager->remove($User);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('admin/liste.html.twig'));
    }
}
