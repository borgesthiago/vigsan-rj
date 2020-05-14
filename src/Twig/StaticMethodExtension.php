<?php


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StaticMethodExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('get_static_method', array($this, 'getStatic')),
        );
    }

    public function getStatic($class, $method)
    {
        if (!class_exists($class)) {
            throw new \Exception(sprintf('Classe %s não encontrada', $class));
        }

        if (!method_exists($class, $method)) {
            throw new \Exception(sprintf('Método %s::%s não encontrado', $class, $method));
        }

        return $class::$method();
    }
}
