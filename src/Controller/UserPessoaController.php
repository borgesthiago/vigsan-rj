<?php

namespace App\Controller;

use App\Entity\UserPessoa;
use App\Form\UserPessoaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user_pessoa")
 */
class UserPessoaController extends AbstractController
{   
    /**
     * @Route("/{id}", name="user_pessoa_show", methods={"GET"})
     */
    public function show(UserPessoa $userPessoa): Response
    {
        return $this->render('user_pessoa/show.html.twig', [
            'user_pessoa' => $userPessoa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_pessoa_edit", methods={"GET","POST"})
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
            return $this->redirectToRoute('painel');
        }

        return $this->render('user_pessoa/edit.html.twig', [
            'user_pessoa' => $userPessoa,
            'form' => $form->createView(),
        ]);
    }
}
