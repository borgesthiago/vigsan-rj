<?php

namespace App\Controller;

use App\Entity\Cidadao;
use App\Form\CidadaoType;
use App\Repository\CidadaoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cidadao")
 */
class CidadaoController extends AbstractController
{
    /**
     * @Route("/", name="cidadao_index", methods={"GET"})
     */
    public function index(CidadaoRepository $cidadaoRepository): Response
    {
        return $this->render('cidadao/index.html.twig', [
            'cidadaos' => $cidadaoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cidadao_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cidadao = new Cidadao();
        $form = $this->createForm(CidadaoType::class, $cidadao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cidadao);
            $entityManager->flush();

            return $this->redirectToRoute('cidadao_index');
        }

        return $this->render('cidadao/new.html.twig', [
            'cidadao' => $cidadao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cidadao_show", methods={"GET"})
     */
    public function show(Cidadao $cidadao): Response
    {
        return $this->render('cidadao/show.html.twig', [
            'cidadao' => $cidadao,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cidadao_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cidadao $cidadao): Response
    {
        $form = $this->createForm(CidadaoType::class, $cidadao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cidadao_index');
        }

        return $this->render('cidadao/edit.html.twig', [
            'cidadao' => $cidadao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cidadao_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cidadao $cidadao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cidadao->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cidadao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cidadao_index');
    }
}
