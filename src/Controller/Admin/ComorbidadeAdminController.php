<?php

namespace App\Controller\Admin;

use App\Entity\Comorbidade;
use App\Form\ComorbidadeType;
use App\Repository\ComorbidadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comorbidade")
 */
class ComorbidadeAdminController extends AbstractController
{
    /**
     * @Route("/", name="comorbidade_index_admin", methods={"GET"})
     */
    public function index(ComorbidadeRepository $comorbidadeRepository): Response
    {
        return $this->render('admin/comorbidade/index.html.twig', [
            'comorbidades' => $comorbidadeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="comorbidade_new_admin", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comorbidade = new Comorbidade();
        $form = $this->createForm(ComorbidadeType::class, $comorbidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comorbidade);
            $entityManager->flush();

            return $this->redirectToRoute('comorbidade_index_admin');
        }

        return $this->render('admin/comorbidade/new.html.twig', [
            'comorbidade' => $comorbidade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comorbidade_show_admin", methods={"GET"})
     */
    public function show(Comorbidade $comorbidade): Response
    {
        return $this->render('admin/comorbidade/show.html.twig', [
            'comorbidade' => $comorbidade,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comorbidade_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Comorbidade $comorbidade): Response
    {
        $form = $this->createForm(ComorbidadeType::class, $comorbidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comorbidade_index_admin');
        }

        return $this->render('admin/comorbidade/edit.html.twig', [
            'comorbidade' => $comorbidade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comorbidade_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, Comorbidade $comorbidade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comorbidade->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comorbidade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comorbidade_index_admin');
    }
}
