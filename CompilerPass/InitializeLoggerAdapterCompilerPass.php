<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Bundle\PayUBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class InitializeLoggerAdapterCompilerPass implements CompilerPassInterface
{
    const LOGGER_ADAPTER_CLASS = 'team3_pay_u.logger_adapter.class';
    const LOGGER_SERVICE_FROM_PARAMETERS = 'team3_pay_u.logger_service';
    const ADAPTED_LOGGER_SERVICE = 'team3_pay_u.logger_adapter';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $loggerAdapterClass = $container->getParameter(self::LOGGER_ADAPTER_CLASS);
        $loggerService = $container->findDefinition(
            $container->getParameter(self::LOGGER_SERVICE_FROM_PARAMETERS)
        );

        $definition = $this->createDefinition($loggerAdapterClass, $loggerService);
        $container->addDefinitions([
            self::ADAPTED_LOGGER_SERVICE => $definition,
        ]);
    }

    /**
     * @param string     $loggerAdapterClass
     * @param Definition $loggerService
     *
     * @return Definition
     */
    private function createDefinition($loggerAdapterClass, Definition $loggerService)
    {
        $definition = new Definition($loggerAdapterClass);
        $definition->addArgument($loggerService);
        $definition->setLazy(true);

        return $definition;
    }
}
