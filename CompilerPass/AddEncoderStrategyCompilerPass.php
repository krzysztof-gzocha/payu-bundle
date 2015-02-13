<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Bundle\PayUBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddEncoderStrategyCompilerPass implements CompilerPassInterface
{
    const ENCODER_SERVICE = 'team3_pay_u.encoder';
    const ENCODER_STRATEGY_TAG = 'team3_pay_u.encoder_strategy';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $encoderService = $container->getDefinition(self::ENCODER_SERVICE);
        $taggedServices = $container->findTaggedServiceIds(self::ENCODER_STRATEGY_TAG);

        foreach (array_keys($taggedServices) as $taggedService) {
            $encoderService->addMethodCall(
                'addStrategy',
                [new Reference($taggedService)]
            );
        }
    }
}
