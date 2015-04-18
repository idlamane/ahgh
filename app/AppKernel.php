<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Amb\AdherentBundle\AmbAdherentBundle(),
            new Amb\CreditBundle\AmbCreditBundle(),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new Amb\DebitBundle\AmbDebitBundle(),
            new Amb\ParamBundle\AmbParamBundle(),
            new Lexik\Bundle\FormFilterBundle\LexikFormFilterBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new Amb\UserBundle\AmbUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Amb\ContratBundle\AmbContratBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Amb\TraceBundle\AmbTraceBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Amb\GlobalBundle\AmbGlobalBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
