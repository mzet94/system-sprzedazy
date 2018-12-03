<?php
/**
 * Location type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LocationType.
 *
 */
class LocationType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder
     * @param FormBuilderInterface $options array
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'city',
            TextType::class,
            [
                'label' => 'label.city',
                'required' => true,
                'attr' => [
                    'max_length' => 30,
                ],
            ]
        )
            ->add(
                'street',
                TextType::class,
                [
                    'label' => 'label.street',
                    'required' => true,
                    'attr' => [
                        'max_length' => 25,
                    ],
                ]
            )
            ->add(
                'number',
                IntegerType::class,
                [
                    'label' => 'label.number',
                    'required' => true,
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'label.name',
                    'required' => true,
                    'attr' => [
                        'max_length' => 25,
                    ],
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
                'data_class' => Location::class,
                'validation_groups' => 'location-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'location_type'
     */
    public function getBlockPrefix()
    {
        return 'location_type';
    }
}
