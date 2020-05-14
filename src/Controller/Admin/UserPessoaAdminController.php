<?php

namespace App\Controller\Admin;

use App\Entity\Pessoa;
use App\Entity\UserPessoa;
use App\Form\UserPessoaType;
use App\Repository\UserPessoaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/user_pessoa")
 */
class UserPessoaAdminController extends AbstractController
{
    /**
     * @Route("/", name="user_pessoa_index_admin", methods={"GET"})
     */
    public function index(UserPessoaRepository $userPessoaRepository): Response
    {
        return $this->render('admin/user_pessoa/index.html.twig', [
            'user_pessoas' => $userPessoaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/pessoa/{pessoa}/new", name="user_pessoa_new_admin", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response
    {
        $userPessoa = new UserPessoa();
        $form = $this->createForm(UserPessoaType::class, $userPessoa);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($userPessoa, $userPessoa->getPassword());
            $userPessoa->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userPessoa);
            $entityManager->flush();
            $this->addFlash("success", "Cadastrado com sucesso.");
            return $this->redirectToRoute('user_pessoa_index_admin');
        }

        return $this->render('admin/user_pessoa/new.html.twig', [
            'user_pessoa' => $userPessoa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_pessoa_show_admin", methods={"GET"})
     */
    public function show(UserPessoa $userPessoa): Response
    {
        return $this->render('admin/user_pessoa/show.html.twig', [
            'user_pessoa' => $userPessoa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_pessoa_edit_admin", methods={"GET","POST"})
     */
    public function edit(
        Request $request,
        UserPessoa $userPessoa,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response
    {
        $form = $this->createForm(UserPessoaType::class, $userPessoa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($userPessoa, $userPessoa->getPassword());
            $userPessoa->setPassword($password);

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Alterado com sucesso.");
            return $this->redirectToRoute('user_pessoa_index_admin');
        }

        return $this->render('admin/user_pessoa/edit.html.twig', [
            'user_pessoa' => $userPessoa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_pessoa_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, UserPessoa $userPessoa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userPessoa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userPessoa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_pessoa_index_admin');
    }
}
