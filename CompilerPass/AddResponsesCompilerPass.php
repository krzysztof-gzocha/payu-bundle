<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Bundle\PayUBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddResponsesCompilerPass implements CompilerPassInterface
{
    const RESPONSE_DESERIALIZER_SERVICE = 'team3_pay_u.communication.response_deserializer';
    const RESPONSE_TAG = 'team3_pay_u.communication.response';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $responseDeserializerService = $container->findDefinition(self::RESPONSE_DESERIALIZER_SERVICE);
        $taggedServices = $container->findTaggedServiceIds(self::RESPONSE_TAG);

        foreach (array_keys($taggedServices) as $taggedService) {
            $responseDeserializerService->addMethodCall(
                'addResponse',
                [new Reference($taggedService)]
            );
        }
    }
}
