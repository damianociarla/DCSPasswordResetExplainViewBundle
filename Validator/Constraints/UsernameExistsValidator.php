<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Validator\Constraints;

use DCS\User\CoreBundle\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsernameExistsValidator extends ConstraintValidator
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * EmailExistsValidator constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        $user = $this->userRepository->findOneByUsername($value);

        if (null === $user) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%username%', $value)
                ->addViolation();
        }
    }
}