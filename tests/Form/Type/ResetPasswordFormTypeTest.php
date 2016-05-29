<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\Form\Type;

use DCS\PasswordReset\Explain\ViewBundle\Form\Type\ResetPasswordFormType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ResetPasswordFormTypeTest extends SetUpFormTestCase
{
    /**
     * @dataProvider getData
     */
    public function testSubmit($first, $second, $expectedCount, $expectedValue)
    {
        $form = $this->factory->create(ResetPasswordFormType::class);
        $form->submit([
            'password' => [
                'first' => $first,
                'second' => $second,
            ],
        ]);

        $this->assertCount($expectedCount, $form->getData());
        $this->assertEquals($expectedValue, $form->get('password')->getData());
    }

    public function getData()
    {
        return [
            ['password','password',1,'password'],
            ['password','passwrod',0,null],
        ];
    }

    protected function getTypes()
    {
        return array_merge(parent::getTypes(), [
            new RepeatedType(),
            new ResetPasswordFormType(),
        ]);
    }
}
