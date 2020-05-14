<?php

namespace App\Controller\Admin;

use App\Entity\Cidadao;
use App\Form\CidadaoType;
use App\Enum\StatusCidadaoEnum;
use App\Enum\ResultadoExameEnum;
use App\Repository\CidadaoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/cidadao")
 */
class CidadaoAdminController extends AbstractController
{
    /**
     * @Route("/", name="cidadao_index_admin", methods={"GET"})
     */
    public function index(CidadaoRepository $cidadaoRepository): Response
    {
        return $this->render('admin/cidadao/index.html.twig', [
            'cidadaos' => $cidadaoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cidadao_new_admin", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cidadao = new Cidadao();
        $form = $this->createForm(CidadaoType::class, $cidadao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cidadao->setStatus(StatusCidadaoEnum::DESCARTADO);

            if ($cidadao->getResultadoExame() == ResultadoExameEnum::DETECTAVEL) {
                $cidadao->setStatus(StatusCidadaoEnum::CONFIRMADO);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cidadao);
            $entityManager->flush();
            
            $this->addFlash("success", "Cadastrado com sucesso.");
            return $this->redirectToRoute('cidadao_index_admin');
        }

        return $this->render('admin/cidadao/new.html.twig', [
            'cidadao' => $cidadao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cidadao_show_admin", methods={"GET"})
     */
    public function show(Cidadao $cidadao): Response
    {
        return $this->render('admin/cidadao/show.html.twig', [
            'cidadao' => $cidadao,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cidadao_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Cidadao $cidadao): Response
    {
        $form = $this->createForm(CidadaoType::class, $cidadao);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cidadao->setStatus(StatusCidadaoEnum::DESCARTADO);

            if ($cidadao->getResultadoExame() == ResultadoExameEnum::DETECTAVEL) {
                $cidadao->setStatus(StatusCidadaoEnum::CONFIRMADO);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cidadao_index_admin');
        }

        return $this->render('admin/cidadao/edit.html.twig', [
            'cidadao' => $cidadao,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cidadao_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, Cidadao $cidadao): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cidadao->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cidadao);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cidadao_index_admin');
    }
}
