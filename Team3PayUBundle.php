<?php

namespace Team3\Bundle\PayUBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Team3\Bundle\PayUBundle\CompilerPass\AddAlgorithmsCompilerPass;
use Team3\Bundle\PayUBundle\CompilerPass\AddEncoderStrategyCompilerPass;
use Team3\Bundle\PayUBundle\CompilerPass\AddResponsesCompilerPass;
use Team3\Bundle\PayUBundle\CompilerPass\InitializeLoggerAdapterCompilerPass;

class Team3PayUBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new InitializeLoggerAdapterCompilerPass());
        $container->addCompilerPass(new AddEncoderStrategyCompilerPass());
        $container->addCompilerPass(new AddAlgorithmsCompilerPass());
        $container->addCompilerPass(new AddResponsesCompilerPass());
    }
}
