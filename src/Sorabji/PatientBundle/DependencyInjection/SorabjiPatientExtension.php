<?php

namespace Sorabji\PatientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SorabjiPatientExtension extends Extension
{
  /**
   * {@inheritDoc}
   */
  public function load(array $configs, ContainerBuilder $container)
  {
    $configuration = new Configuration();
    /* $hrm = $configuration->getConfigTreeBuilder()->buildTree(); */
    /* var_dump($hrm); die(); */

    /* foreach(get_class_methods($configuration->getConfigTreeBuilder()) as $m){ */
    /*   echo $m . PHP_EOL; */
    /* } die(); */
    $config = $this->processConfiguration($configuration, $configs);

    $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    $loader->load('services.xml');

    $container->setParameter('patient_config', $config);
  }
}
