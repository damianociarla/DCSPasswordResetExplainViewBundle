<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Controller;

use DCS\PasswordReset\CoreBundle\Exception;
use DCS\PasswordReset\Explain\ViewBundle\DCSPasswordResetExplainViewEvents;
use DCS\PasswordReset\Explain\ViewBundle\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class PasswordResetController extends Controller
{
    /**
     * Action that exposes the form for a new change password request
     *
     * @see DCS/PasswordReset/Explain/ViewBundle/Resources/config/routing/password_reset.xml
     */
    public function createRequestAction(Request $request)
    {
        $form = $this->createForm($this->getParameter('dcs_password_reset.explain.view.form.request'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $user = $this->get('dcs_user.repository')->findOneByUsername($form->get('username')->getData());

                $createResetRequest = $this->get('dcs_password_reset.handler.create_reset_request');
                $resetRequest = $createResetRequest($user);

                $event = new Event\ResetRequestHttpRequestResponseEvent($resetRequest, $request);
                $this->get('event_dispatcher')->dispatch(DCSPasswordResetExplainViewEvents::RESET_REQUEST_CREATED_SUCCESSFULLY, $event);

                if (null === $response = $event->getResponse()) {
                    $response = $this->redirectToRoute('dcs_password_reset_request');
                }

                return $response;
            } catch (Exception\UnauthorizedCreateNewResetRequestException $e) {
                $form->addError(new FormError($this->trans('create_request.username.unauthorized_create_new_reset_request')));
            }

            $this->get('event_dispatcher')->dispatch(
                DCSPasswordResetExplainViewEvents::CREATE_RESET_REQUEST_FAILED,
                new Event\HttpRequestFormEvent($request, $form)
            );
        }

        return $this->render($this->getParameter('dcs_password_reset.explain.view.template.request'), [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Action that exposes the form for the change password
     *
     * @see DCS/PasswordReset/Explain/ViewBundle/Resources/config/routing/password_reset.xml
     */
    public function resetAction(Request $request, $token)
    {
        $resetRequest = $this->get('dcs_password_reset.repository')->findOneByToken($token);

        if (null === $resetRequest) {
            $this->createNotFoundException($this->trans('reset_password.token_does_not_exists'));
        }

        $form = $this->createForm($this->getParameter('dcs_password_reset.explain.view.form.reset'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $resetPasswordFromToken = $this->get('dcs_password_reset.handler.reset_password');
                $resetPasswordFromToken($resetRequest, $form->get('password')->getData());

                $event = new Event\ResetRequestHttpRequestResponseEvent($resetRequest, $request);
                $this->get('event_dispatcher')->dispatch(DCSPasswordResetExplainViewEvents::PASSWORD_UPDATED_SUCCESSFULLY, $event);

                if (null === $response = $event->getResponse()) {
                    $response = $this->redirectToRoute('dcs_password_reset_request');
                }

                return $response;
            } catch (Exception\ResetRequestAlreadyUsedException $e) {
                $form->addError(new FormError($this->trans('reset_password.reset_request_already_used')));
            } catch (Exception\TimeToLiveException $e) {
                $form->addError(new FormError($this->trans('reset_password.reset_request_is_not_available')));
            } catch (Exception\UnauthorizedResetPasswordException $e) {
                $form->addError(new FormError($this->trans('reset_password.unauthorized_reset_password')));
            }

            $this->get('event_dispatcher')->dispatch(
                DCSPasswordResetExplainViewEvents::RESET_PASSWORD_FAILED,
                new Event\ResetRequestHttpRequestFormEvent($resetRequest, $request, $form)
            );
        }

        return $this->render($this->getParameter('dcs_password_reset.explain.view.template.reset'), [
            'form' => $form->createView(),
            'token' => $token,
        ]);
    }

    /**
     * Translates a string with the correct domain
     *
     * @param string $message
     * @param array $parameters
     * @return string
     */
    protected function trans($message, array $parameters = [])
    {
        return $this->get('translator')->trans($message, $parameters, 'DCSPasswordResetExplainViewBundle');
    }
}