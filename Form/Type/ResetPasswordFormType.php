<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class ResetPasswordFormType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'reset.password.mismatch',
            'first_options'  => [
                'label' => 'form.label.new_password'
            ],
            'second_options' => [
                'label' => 'form.label.repeat_password'
            ],
            'translation_domain' => 'DCSPasswordResetExplainViewBundle',
        ]);
    }
}