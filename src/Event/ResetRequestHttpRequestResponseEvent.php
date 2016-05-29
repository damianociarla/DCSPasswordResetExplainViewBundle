<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Event;

use DCS\PasswordReset\CoreBundle\Model\ResetRequestInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResetRequestHttpRequestResponseEvent extends Event
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
     * @var Response
     */
    private $response;

    /**
     * ResetRequestHttpRequestEvent constructor.
     *
     * @param ResetRequestInterface $resetRequest
     * @param Request $request
     */
    public function __construct(ResetRequestInterface $resetRequest, Request $request)
    {
        $this->resetRequest = $resetRequest;
        $this->request = $request;
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
     * Get response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets response
     *
     * @param Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}