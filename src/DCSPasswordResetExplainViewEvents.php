<?php

namespace DCS\PasswordReset\Explain\ViewBundle;

class DCSPasswordResetExplainViewEvents
{
    const CREATE_RESET_REQUEST_FAILED        = 'dcs_password_reset.explain.view.event.create_reset_request_failed';
    const RESET_REQUEST_CREATED_SUCCESSFULLY = 'dcs_password_reset.explain.view.event.reset_request_created_successfully';
    const RESET_PASSWORD_FAILED              = 'dcs_password_reset.explain.view.event.reset_password_failed';
    const PASSWORD_UPDATED_SUCCESSFULLY      = 'dcs_password_reset.explain.view.event.password_updated_successfully';
}