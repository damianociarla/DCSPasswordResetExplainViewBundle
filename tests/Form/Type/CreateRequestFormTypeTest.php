<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Tests\Form\Type;

use DCS\PasswordReset\Explain\ViewBundle\Form\Type\CreateRequestFormType;

class CreateRequestFormTypeTest extends SetUpFormTestCase
{
    public function testSubmit()
    {
        $form = $this->factory->create(CreateRequestFormType::class);
        $form->submit([
            'username' => 'johndoe',
        ]);

        $this->assertCount(1, $form->getData());
        $this->assertEquals('johndoe', $form->get('username')->getData());
    }

    protected function getTypes()
    {
        return array_merge(parent::getTypes(), [
            new CreateRequestFormType(),
        ]);
    }
}
