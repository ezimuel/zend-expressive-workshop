<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Db\Adapter\AdapterInterface;
use App\Model\Speaker;

class SpeakerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;
        $adapter = ($container->has(AdapterInterface::class))
            ? $container->get(AdapterInterface::class)
            : null;

        return new SpeakerAction(new Speaker($adapter), $template);
    }
}
