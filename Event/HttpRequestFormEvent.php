<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class HttpRequestFormEvent extends Event
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Form
     */
    private $form;

    /**
     * ResetRequestHttpRequestExceptionFormEvent constructor.
     *
     * @param Request $request
     * @param Form $form
     */
    public function __construct(Request $request, Form $form)
    {
        $this->request = $request;
        $this->form = $form;
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get form
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }
}