<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Bundle\PayUBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddAlgorithmsCompilerPass implements CompilerPassInterface
{
    const ALGORITHMS_PROVIDER_SERVICE = 'team3_pay_u.algorithms_provider';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $algorithmsProviderService = $container
            ->getDefinition(self::ALGORITHMS_PROVIDER_SERVICE);
        $taggedServices = $container->findTaggedServiceIds(self::ALGORITHMS_PROVIDER_SERVICE);

        foreach (array_keys($taggedServices) as $taggedService) {
            $algorithmsProviderService->addMethodCall(
                'addAlgorithm',
                [new Reference($taggedService)]
            );
        }
    }
}
