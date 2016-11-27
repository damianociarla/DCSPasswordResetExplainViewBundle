<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\Validator\Constraints;

use DCS\PasswordReset\Explain\ViewBundle\Validator\Constraints\UsernameExists;
use DCS\PasswordReset\Explain\ViewBundle\Validator\Constraints\UsernameExistsValidator;
use DCS\User\CoreBundle\Model\UserInterface;
use DCS\User\CoreBundle\Repository\UserRepositoryInterface;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;

class UsernameExistsValidatorTest extends AbstractConstraintValidatorTest
{
    const VALID_USERNAME = 'johndoe';

    protected function createValidator()
    {
        $user = $this->getMockBuilder(UserInterface::class)->getMock();
        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();

        $userRepository
            ->expects($this->any())
            ->method('findOneByUsername')
            ->will($this->returnCallback(
                function ($username) use ($user) {
                    return $username === self::VALID_USERNAME ? $user : null;
                }
            ));

        return new UsernameExistsValidator($userRepository);
    }

    public function testValidatedBy()
    {
        $validator = new UsernameExists();
        $this->assertEquals('username_exists', $validator->validatedBy());
    }

    public function testValidUsername()
    {
        $this->validator->validate(self::VALID_USERNAME, new UsernameExists());
        $this->assertNoViolation();
    }

    public function testInvalidUsername()
    {
        $username = 'doejohn';

        $this->validator->validate($username, new UsernameExists([
            'message' => 'myMessage',
        ]));

        $this->buildViolation('myMessage')
            ->setParameter('%username%', $username)
            ->assertRaised();
    }
}