<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Event;

use DCS\PasswordReset\CoreBundle\Model\ResetRequestInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ResetRequestHttpRequestFormEvent extends HttpRequestFormEvent
{
    /**
     * @var ResetRequestInterface
     */
    private $resetRequest;

    /**
     * ResetRequestHttpRequestExceptionFormEvent constructor.
     *
     * @param ResetRequestInterface $resetRequest
     * @param Request $request
     * @param Form $form
     */
    public function __construct(ResetRequestInterface $resetRequest, Request $request, Form $form)
    {
        parent::__construct($request, $form);
        $this->resetRequest = $resetRequest;
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
}