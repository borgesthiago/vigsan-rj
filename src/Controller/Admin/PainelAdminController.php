<?php

namespace App\Controller\Admin;

use App\Repository\CidadaoRepository;
use App\Repository\UnidadeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/admin")
 */
class PainelAdminController extends AbstractController
{
    /**
     * @Route("/", name="painel_admin")
     */
    public function index(
        UnidadeRepository $unidadeRepository,
        CidadaoRepository $cidadaoRepository
    ) {    
        $user = $this->getUser();

        $unidades = $unidadeRepository->totalUnidades();
        $cidadaos = $cidadaoRepository->totalCidadaos();

        $exames = $cidadaoRepository->totalCidadaosResultadoExame();
        $detectavel = $cidadaoRepository->totalCidadaosResultadoExameDetectavel();
        $uti = $cidadaoRepository->totalCidadaosUti();
        $sivep = $cidadaoRepository->totalCidadaosSivep();
        $altas = $cidadaoRepository->totalCidadaosEvolucaoAltas();
        $obitos = $cidadaoRepository->totalCidadaosEvolucaoObitos();
        $transferidos = $cidadaoRepository->totalCidadaosEvolucaoTransferidos();
        $ventilacao = $cidadaoRepository->totalCidadaosVentilacao();

        $totalPacientesUnidade = $cidadaoRepository->totalCidadaoPorUnidade();

        $totalNotificacaoUnidade = $cidadaoRepository->totalDataNotificacaoPorUnidade();
        
        return $this->render (
            'admin/painel/index.html.twig',
            [
                'controller_name' => 'PainelController',
                'unidades' => $unidades,
                'cidadaos' => $cidadaos,
                'exames' => $exames,
                'detectavel' => $detectavel,
                'uti' => $uti,
                'sivep' => $sivep,
                'altas' => $altas,
                'obitos' => $obitos,
                'transferidos' => $transferidos,
                'ventilacao' => $ventilacao,
                'totalPacientesUnidades' => $totalPacientesUnidade,
                'totalNotificacaoUnidade' => $totalNotificacaoUnidade,
            ]
        );
    }
}
