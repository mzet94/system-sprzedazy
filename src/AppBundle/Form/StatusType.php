<?php
/**
 * Status type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Status;
use AppBundle\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StatusType.
 *
 */
class StatusType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder
     * @param FormBuilderInterface $options array
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'status',
                EntityType::class,
                [
                    'class' => Status::class,
                    'choice_label' => function ($status) {
                        return $status->getName();
                    },
                    'placeholder' => false,
                    'label' => 'label.status',
                    'required' => true,
                    'multiple' => false,
                            ]
            );
    }

    /**
     * Options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Status::class,
                'validation_groups' => 'Status-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'status_type'
     */
    public function getBlockPrefix()
    {
        return 'status_type';
    }
}
