<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

  public function init(){
    date_default_timezone_set( 'America/New_York' ); /* Eastern Standard Time for all dateij */
    parent::init();
  }

  public function registerBundles()
  {
    $bundles = array(
      new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
      new Symfony\Bundle\SecurityBundle\SecurityBundle(),
      new Symfony\Bundle\TwigBundle\TwigBundle(),
      new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
      new Symfony\Bundle\MonologBundle\MonologBundle(),
      new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
      new Symfony\Bundle\AsseticBundle\AsseticBundle(),
      new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
      new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
      new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
      new JMS\AopBundle\JMSAopBundle(),
      new JMS\DiExtraBundle\JMSDiExtraBundle($this),
      new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
      new FOS\UserBundle\FOSUserBundle(),
      new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
      new Sorabji\PatientBundle\SorabjiPatientBundle(),
    );

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
      $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
      $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
      $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
    }

    return $bundles;
  }

  public function registerContainerConfiguration(LoaderInterface $loader)
  {
    $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
  }
}
