<?php

namespace DCS\PasswordReset\Explain\ViewBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

class DCSPasswordResetExplainViewExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('dcs_password_reset.explain.view.template.request', $config['template']['request']);
        $container->setParameter('dcs_password_reset.explain.view.template.reset', $config['template']['reset']);

        $container->setParameter('dcs_password_reset.explain.view.form.request', $config['form']['request']);
        $container->setParameter('dcs_password_reset.explain.view.form.reset', $config['form']['reset']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('validator.xml');
    }
}