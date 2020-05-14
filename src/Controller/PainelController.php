<?php

namespace App\Controller;

use App\Repository\CidadaoRepository;
use App\Repository\UnidadeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/")
 */
class PainelController extends AbstractController
{
    /**
     * @Route("/", name="painel")
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
            'painel/index.html.twig',
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
