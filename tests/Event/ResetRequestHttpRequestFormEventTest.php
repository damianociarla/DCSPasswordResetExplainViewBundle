<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\Event;

use DCS\PasswordReset\CoreBundle\Model\ResetRequestInterface;
use DCS\PasswordReset\Explain\ViewBundle\Event\HttpRequestFormEvent;
use DCS\PasswordReset\Explain\ViewBundle\Event\ResetRequestHttpRequestFormEvent;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\HttpFoundation\Request;

class ResetRequestHttpRequestFormEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $resetRequest = $this->createMock(ResetRequestInterface::class);
        $request = Request::createFromGlobals();
        $form = new Form($this->createMock(FormConfigInterface::class));

        $event = new ResetRequestHttpRequestFormEvent($resetRequest, $request, $form);

        $this->assertInstanceOf(HttpRequestFormEvent::class, $event);

        return $event;
    }

    /**
     * @depends testConstructor
     */
    public function testGetResetRequestMethod(ResetRequestHttpRequestFormEvent $event)
    {
        $this->assertInstanceOf(ResetRequestInterface::class, $event->getResetRequest());
    }
}