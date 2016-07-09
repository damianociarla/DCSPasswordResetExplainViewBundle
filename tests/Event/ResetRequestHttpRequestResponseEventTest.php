<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\Event;

use DCS\PasswordReset\CoreBundle\Model\ResetRequestInterface;
use DCS\PasswordReset\Explain\ViewBundle\Event\ResetRequestHttpRequestResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResetRequestHttpRequestResponseEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $resetRequest = $this->createMock(ResetRequestInterface::class);
        $request = Request::createFromGlobals();

        return new ResetRequestHttpRequestResponseEvent($resetRequest, $request);
    }

    /**
     * @depends testConstructor
     */
    public function testGetResetRequestMethod(ResetRequestHttpRequestResponseEvent $event)
    {
        $this->assertInstanceOf(ResetRequestInterface::class, $event->getResetRequest());
    }

    /**
     * @depends testConstructor
     */
    public function testGetRequestMethod(ResetRequestHttpRequestResponseEvent $event)
    {
        $this->assertInstanceOf(Request::class, $event->getRequest());
    }

    /**
     * @depends testConstructor
     */
    public function testNullGetResponseMethod(ResetRequestHttpRequestResponseEvent $event)
    {
        $this->assertNull($event->getResponse());
    }

    /**
     * @depends testConstructor
     */
    public function testSetAndGetResponseMethod(ResetRequestHttpRequestResponseEvent $event)
    {
        $response = $this->createMock(Response::class);
        $event->setResponse($response);

        $this->assertInstanceOf(Response::class, $event->getResponse());
    }
}