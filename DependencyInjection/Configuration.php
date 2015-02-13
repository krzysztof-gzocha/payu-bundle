<?php

namespace Team3\Bundle\PayUBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Team3\PayU\Configuration\Credentials\TestCredentials;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('team3_pay_u');

        $rootNode
            ->children()
            ->scalarNode('logger_service')
                ->cannotBeEmpty()
                ->defaultValue('monolog.logger')
                ->end()
            ->scalarNode('signature_algorithm_class')
                ->cannotBeEmpty()
                ->defaultValue('Team3\PayU\SignatureCalculator\Encoder\Algorithms\Md5Algorithm')
                ->end()
            ->booleanNode('sandbox')
                ->cannotBeEmpty()
                ->defaultFalse()
                ->end()
            ->scalarNode('merchant_id')
                ->cannotBeEmpty()
                ->defaultValue(TestCredentials::MERCHANT_POS_ID)
                ->end()
            ->scalarNode('private_key')
                ->cannotBeEmpty()
                ->defaultValue(TestCredentials::PRIVATE_KEY)
                ->end()
            ->scalarNode('protocol')
                ->cannotBeEmpty()
                ->defaultValue('https')
                ->end()
            ->scalarNode('domain')
                ->cannotBeEmpty()
                ->defaultValue('secure.payu.com')
                ->end()
            ->scalarNode('path')
                ->cannotBeEmpty()
                ->defaultValue('api')
                ->end()
            ->scalarNode('version')
                ->cannotBeEmpty()
                ->defaultValue('v2_1')
                ->end()
            ->scalarNode('encryption_protocol')
                ->cannotBeEmpty()
                ->defaultValue('TLSv1')
                ->end();

        return $treeBuilder;
    }
}
