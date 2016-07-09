<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\Event;

use DCS\PasswordReset\Explain\ViewBundle\Event\HttpRequestFormEvent;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\HttpFoundation\Request;

class HttpRequestFormEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $request = Request::createFromGlobals();
        $form = new Form($this->createMock(FormConfigInterface::class));

        return new HttpRequestFormEvent($request, $form);
    }

    /**
     * @depends testConstructor
     */
    public function testGetRequestMethod(HttpRequestFormEvent $event)
    {
        $this->assertInstanceOf(Request::class, $event->getRequest());
    }

    /**
     * @depends testConstructor
     */
    public function testGetFormMethod(HttpRequestFormEvent $event)
    {
        $this->assertInstanceOf(Form::class, $event->getForm());
    }
}