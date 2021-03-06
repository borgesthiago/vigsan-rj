<?php

namespace App\Controller\Admin;

use App\Entity\Unidade;
use App\Form\UnidadeType;
use App\Repository\CidadaoRepository;
use App\Repository\UnidadeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/unidade")
 */
class UnidadeAdminController extends AbstractController
{
    /**
     * @Route("/", name="unidade_index_admin", methods={"GET"})
     */
    public function index(UnidadeRepository $unidadeRepository): Response
    {
        return $this->render('admin/unidade/index.html.twig', [
            'unidades' => $unidadeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="unidade_new_admin", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $unidade = new Unidade();
        $form = $this->createForm(UnidadeType::class, $unidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unidade);
            $entityManager->flush();

            return $this->redirectToRoute('unidade_index_admin');
        }

        return $this->render('admin/unidade/new.html.twig', [
            'unidade' => $unidade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unidade_show_admin", methods={"GET"})
     */
    public function show(Unidade $unidade, CidadaoRepository $cidadaoRepository): Response
    {
        $cidadaos = $cidadaoRepository->findBy([
            'unidade' => $unidade
        ]);

        return $this->render('admin/unidade/show.html.twig', [
            'unidade' => $unidade,
            'cidadaos' => $cidadaos
        ]);
    }

    /**
     * @Route("/{id}/edit", name="unidade_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Unidade $unidade): Response
    {
        $form = $this->createForm(UnidadeType::class, $unidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unidade_index_admin');
        }

        return $this->render('admin/unidade/edit.html.twig', [
            'unidade' => $unidade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unidade_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, Unidade $unidade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unidade->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unidade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unidade_index_admin');
    }
}
