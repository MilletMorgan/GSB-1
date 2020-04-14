<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;

/**
// * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/liste", name="adminliste")
     */
    public function adminListe(){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $User = $repository->findAll();

        return $this->render('admin/liste.html.twig', array(
            'Users' => $User
        ));

    }

    /**
     * @Route("/edit/{userId}", name="editUser")
     * @param $userId
     * @param UserRepository $userRepository
     * @param Request $request
     * @return RedirectResponse|Response
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
     * @Route("/delete/{id}", name="deleteUser")
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $User = $entityManager->getRepository(User::class)->find($id);

        $entityManager->remove($User);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('adminliste'));
    }
}
