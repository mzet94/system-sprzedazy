<?php
/**
 * Director type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Director;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DirectorType.
 *
 */
class DirectorType extends AbstractType
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
                'data_class' => Director::class,
                'validation_groups' => 'director-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'director_type'
     */
    public function getBlockPrefix()
    {
        return 'director_type';
    }
}
