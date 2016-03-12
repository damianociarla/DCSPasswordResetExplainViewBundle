<?php

namespace DCS\PasswordReset\Explain\ViewBundle\DependencyInjection;

use DCS\PasswordReset\Explain\ViewBundle\Form\Type\CreateRequestFormType;
use DCS\PasswordReset\Explain\ViewBundle\Form\Type\ResetPasswordFormType;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dcs_password_reset_explain_view');

        $rootNode
            ->children()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('request')
                            ->defaultValue('DCSPasswordResetExplainViewBundle:PasswordReset:create_request.html.twig')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('reset')
                            ->defaultValue('DCSPasswordResetExplainViewBundle:PasswordReset:reset.html.twig')
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('request')
                            ->defaultValue(CreateRequestFormType::class)
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('reset')
                            ->defaultValue(ResetPasswordFormType::class)
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}