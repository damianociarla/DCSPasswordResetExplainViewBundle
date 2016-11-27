<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\DependencyInjection;

use DCS\PasswordReset\Explain\ViewBundle\DependencyInjection\Configuration;
use DCS\PasswordReset\Explain\ViewBundle\Form\Type\CreateRequestFormType;
use DCS\PasswordReset\Explain\ViewBundle\Form\Type\ResetPasswordFormType;
use Symfony\Component\Config\Definition\ArrayNode;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\ScalarNode;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConfigurationInterface::class, $this->configuration);
    }

    public function testGetConfigTreeBuilder()
    {
        $this->assertInstanceOf(TreeBuilder::class, $this->configuration->getConfigTreeBuilder());
    }

    public function testRootNodeNameBuilder()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();
        $this->assertEquals('dcs_password_reset_explain_view', $treeBuilder->buildTree()->getName());
    }

    public function testTemplateNode()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();

        /** @var \Symfony\Component\Config\Definition\ArrayNode $tree */
        $tree = $treeBuilder->buildTree();

        $children = $tree->getChildren();

        $this->assertArrayHasKey('template', $children);
        $this->assertInstanceOf(ArrayNode::class, $children['template']);

        $this->assertCount(2, $templateChildren = $children['template']->getChildren());

        $this->assertArrayHasKey('request', $templateChildren);
        $this->assertInstanceOf(ScalarNode::class, $templateChildren['request']);
        $this->assertEquals('DCSPasswordResetExplainViewBundle:PasswordReset:create_request.html.twig', $templateChildren['request']->getDefaultValue());

        $this->assertArrayHasKey('reset', $templateChildren);
        $this->assertInstanceOf(ScalarNode::class, $templateChildren['reset']);
        $this->assertEquals('DCSPasswordResetExplainViewBundle:PasswordReset:reset.html.twig', $templateChildren['reset']->getDefaultValue());
    }

    public function testFormNode()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();

        /** @var \Symfony\Component\Config\Definition\ArrayNode $tree */
        $tree = $treeBuilder->buildTree();

        $children = $tree->getChildren();

        $this->assertArrayHasKey('form', $children);
        $this->assertInstanceOf(ArrayNode::class, $children['form']);

        $this->assertCount(2, $formChildren = $children['form']->getChildren());

        $this->assertArrayHasKey('request', $formChildren);
        $this->assertInstanceOf(ScalarNode::class, $formChildren['request']);
        $this->assertEquals(CreateRequestFormType::class, $formChildren['request']->getDefaultValue());

        $this->assertArrayHasKey('reset', $formChildren);
        $this->assertInstanceOf(ScalarNode::class, $formChildren['reset']);
        $this->assertEquals(ResetPasswordFormType::class, $formChildren['reset']->getDefaultValue());
    }
}