<?php
/**
 * Play type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Play;
use AppBundle\Entity\Director;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PlayType.
 *
 */
class PlayType extends AbstractType
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
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => true,
                'attr' => [
                    'min_length' => 3,
                    'max_length' => 50,
                ],
            ]
        )
            ->add(
                'director',
                EntityType::class,
                [
                    'class' => director::class,
                    'choice_label' => function ($director) {
                        return $director->getSurname();
                    },
                    'placeholder' => false,
                    'label' => 'label.director',
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
                'data_class' => Play::class,
                'validation_groups' => 'Play-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'play_type'
     */
    public function getBlockPrefix()
    {
        return 'play_type';
    }
}
