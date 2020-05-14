<?php

namespace App\Controller\Admin;

use App\Entity\UserAdmin;
use App\Form\UserAdminType;
use App\Repository\UserAdminRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/user")
 */
class UserAdminController extends AbstractController
{
    /**
     * @Route("/", name="user_admin_index", methods={"GET"})
     */
    public function index(UserAdminRepository $userAdminRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userAdminRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_admin_new", methods={"GET","POST"})
     */
    public function new(
    Request $request,
    UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new UserAdmin();
        $form = $this->createForm(UserAdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $form->getData()->getPassword());
            $user
                ->setPassword($password)
            ;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash("success", "Cadastrado com sucesso.");
            return $this->redirectToRoute('user_admin_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_admin_show", methods={"GET"})
     */
    public function show(UserAdmin $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserAdmin $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserAdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", "Alterado com sucesso.");

            return $this->redirectToRoute('user_admin_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserAdmin $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        $this->addFlash("success", "Apagado com sucesso.");
        return $this->redirectToRoute('user_admin_index');
    }
}
