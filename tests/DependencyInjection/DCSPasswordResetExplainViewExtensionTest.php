<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\DependencyInjection;

use DCS\PasswordReset\Explain\ViewBundle\DependencyInjection\DCSPasswordResetExplainViewExtension;
use DCS\PasswordReset\Explain\ViewBundle\Form\Type\CreateRequestFormType;
use DCS\PasswordReset\Explain\ViewBundle\Form\Type\ResetPasswordFormType;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSPasswordResetExplainViewExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoad()
    {
        $container = new ContainerBuilder();

        $mock = $this->getMockBuilder(DCSPasswordResetExplainViewExtension::class)->setMethods(['processConfiguration'])->getMock();
        $mock->load([], $container);

        return $container;
    }

    /**
     * @depends testLoad
     */
    public function testContainsParameters(ContainerBuilder $container)
    {
        $this->assertTrue($container->hasParameter('dcs_password_reset.explain.view.template.request'));
        $this->assertTrue($container->hasParameter('dcs_password_reset.explain.view.template.reset'));

        $this->assertEquals('DCSPasswordResetExplainViewBundle:PasswordReset:create_request.html.twig', $container->getParameter('dcs_password_reset.explain.view.template.request'));
        $this->assertEquals('DCSPasswordResetExplainViewBundle:PasswordReset:reset.html.twig', $container->getParameter('dcs_password_reset.explain.view.template.reset'));

        $this->assertTrue($container->hasParameter('dcs_password_reset.explain.view.form.request'));
        $this->assertTrue($container->hasParameter('dcs_password_reset.explain.view.form.reset'));

        $this->assertEquals(CreateRequestFormType::class, $container->getParameter('dcs_password_reset.explain.view.form.request'));
        $this->assertEquals(ResetPasswordFormType::class, $container->getParameter('dcs_password_reset.explain.view.form.reset'));
    }

    /**
     * @depends testLoad
     */
    public function testContainsLoadedXMLFiles(ContainerBuilder $container)
    {
        $this->assertCount(1, $resources = $container->getResources());

        /** @var FileResource $resource */
        foreach ($resources as $resource) {
            $this->assertContains(pathinfo($resource->getResource(), PATHINFO_BASENAME), ['validator.xml']);
        }
    }
}