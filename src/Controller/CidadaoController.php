<?php

namespace App\Controller;

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
            $cidadao->setStatus(StatusCidadaoEnum::DESCARTADO);

            if ($cidadao->getResultadoExame() == ResultadoExameEnum::DETECTAVEL) {
                $cidadao->setStatus(StatusCidadaoEnum::CONFIRMADO);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cidadao);
            $entityManager->flush();
            
            $this->addFlash("success", "Cadastrado com sucesso.");
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
            $cidadao->setStatus(StatusCidadaoEnum::DESCARTADO);

            if ($cidadao->getResultadoExame() == ResultadoExameEnum::DETECTAVEL) {
                $cidadao->setStatus(StatusCidadaoEnum::CONFIRMADO);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cidadao_index');
        }

        return $this->render('cidadao/edit.html.twig', [
            'cidadao' => $cidadao,
            'form' => $form->createView(),
        ]);
    }
}
