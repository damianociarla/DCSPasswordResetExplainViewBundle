<?php

namespace DCS\PasswordReset\Explain\ViewBundle\Form\Type;

use DCS\PasswordReset\Explain\ViewBundle\Validator\Constraints\UsernameEnabledCreateResetRequest;
use DCS\PasswordReset\Explain\ViewBundle\Validator\Constraints\UsernameExists;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateRequestFormType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, [
            'label' => 'form.label.username',
            'constraints' => [
                new NotBlank(),
                new UsernameExists(['message' => 'create_request.username.not_exists']),
            ],
            'translation_domain' => 'DCSPasswordResetExplainViewBundle',
        ]);
    }
}