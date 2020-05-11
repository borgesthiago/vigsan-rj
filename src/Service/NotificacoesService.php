<?php

namespace App\Service;

use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Notifier\Notification\Notification;

class NotificacoesService
{
    public function getTelegram(ChatterInterface $chatter, $parametros)
    {
        $texto = $parametros['mensagem'] . ' Ação: ' . $parametros['acao'] .', Id: '
                .$parametros['id'] .' em ' . $parametros['dataHora'];
        
        $message = (new ChatMessage($texto))
        ->transport('telegram');
        $chatter->send($message);

        return;
    }

    public function getSlack(NotifierInterface $notifier, $parametros)
    {
        $texto = $parametros['mensagem'] . ' Ação: ' . $parametros['acao'] .' em ' . $parametros['dataHora'];

        $notification = (new Notification('Nova Notificação'))
        ->content($texto)
        ->importance(Notification::IMPORTANCE_URGENT);

        $notifier->send($notification, new Recipient('suporte@jbfsi.com.br'));
        
        return;
    }    
}
