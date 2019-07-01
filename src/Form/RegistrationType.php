<?php
// src/AppBundle/Form/RegistrationType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationType extends AbstractType
{
    private $userPassWordInterface;
    public function __construct(
        UserPasswordEncoderInterface $userPassWordInterface
    )
    {
        $this->userPassWordInterface = $userPassWordInterface;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom')
            ->addEventListener(
                FormEvents::SUBMIT,
                [$this, 'onSubmit']
            )
        ;
    }

    public function onSubmit(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        if (!$user) {
            return;
        }
        $passWord = $this->userPassWordInterface->encodePassword($user, $user->getPlainPassword());
        $user->setPassWord($passWord);

        // checks whether the user has chosen to display their email or not.
        // If the data was submitted previously, the additional value that
        // is included in the request variables needs to be removed.

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}