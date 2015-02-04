<?php

namespace Team3\Bundle\PayUBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class Team3PayUExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->setParameters($config, $container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('configuration.yml');
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function setParameters(array $config, ContainerBuilder $container)
    {
        foreach ($config as $parameterName => $parameterValue) {
            $container->setParameter(
                sprintf('team3_pay_u.%s', $parameterName),
                $parameterValue
            );
        }
    }
}
