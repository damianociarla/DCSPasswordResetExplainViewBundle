<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Event;

use DCS\PasswordReset\CoreBundle\Model\ResetRequestInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ResetRequestHttpRequestFormEvent extends Event
{
    /**
     * @var ResetRequestInterface
     */
    private $resetRequest;

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
     * @param ResetRequestInterface $resetRequest
     * @param Request $request
     * @param Form $form
     */
    public function __construct(ResetRequestInterface $resetRequest, Request $request, Form $form)
    {
        $this->resetRequest = $resetRequest;
        $this->request = $request;
        $this->form = $form;
    }

    /**
     * Get resetRequest
     *
     * @return ResetRequestInterface
     */
    public function getResetRequest()
    {
        return $this->resetRequest;
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