<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UsernameExists extends Constraint
{
    public $message = 'The username "%username%" does not exist';

    public function validatedBy()
    {
        return 'username_exists';
    }
}