<?php
/**
 * Detail type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Detail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Class DetailType.
 *
 */
class DetailType extends AbstractType
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
            'firstName',
            TextType::class,
            [
                'label' => 'label.firstName',
                'required' => true,
                'attr' => [
                    'max_length' => 15,
                ],
            ]
        )
            ->add(
                'surname',
                TextType::class,
                [
                    'label' => 'label.surname',
                    'required' => true,
                    'attr' => [
                        'max_length' => 20,
                    ],
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'label.phone',
                    'required' => true,
                    'attr' => [
                        'min_length' => 9,
                        'max_length' => 9,
                    ],

                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'label.city',
                    'required' => true,
                ]
            )
            ->add(
                'street',
                TextType::class,
                [
                    'label' => 'label.street',
                    'required' => true,
                    'attr' => [
                        'max_length' => 30,
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
                'post',
                TextType::class,
                [
                    'label' => 'label.post',
                    'required' => true,
                    'attr' => [
                        'max_length' => 6,
                        'min_length' => 6,
                    ],
                ]
            )
        ;
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
                'data_class' => Detail::class,
                'validation_groups' => 'detail-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'detail_type'
     */
    public function getBlockPrefix()
    {
        return 'detail_type';
    }
}
