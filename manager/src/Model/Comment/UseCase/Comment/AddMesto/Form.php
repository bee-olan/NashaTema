<?php

declare(strict_types=1);

namespace App\Model\Comment\UseCase\Comment\AddMesto;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', Type\TextareaType::class,[
                'label' => 'Запрос ',
                'attr' => [
                    'rows' => 3,
                    'placeholder' => 'Округ - Регион/Область - Район '
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => Command::class,
        ));
    }

    public function getBlockPrefix(): string
    {
        return 'comment';
    }
}
