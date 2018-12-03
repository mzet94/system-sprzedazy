<?php
/**
 * Spectacle type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Spectacle;
use AppBundle\Entity\Location;
use AppBundle\Entity\Play;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

/**
 * Class SpectacleType.
 *
 */
class SpectacleType extends AbstractType
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
            'date',
            DateType::class,
            [
                'label' => 'label.date',
                'required' => true,
                'format' => 'dd/MM/yyyy',
                'data' => new \DateTime(),
                'attr' => array(
                    'min' => (new \DateTime())->format('string'),
                    'max' => (new \DateTime())->format('string'),
                ),
                'placeholder'  => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day', ),
            ]
        )
            ->add(
                'time',
                TimeType::class,
                [
                    'label' => 'label.time',
                    'required' => true,
                    'widget' => 'choice',
                ]
            )
            ->add(
                'seats',
                IntegerType::class,
                [
                    'label' => 'label.seats',
                    'required' => true,
                ]
            )
            ->add(
                'price',
                IntegerType::class,
                [
                    'label' => 'label.price',
                    'required' => true,
                ]
            )
            ->add(
                'location',
                EntityType::class,
                [
                    'class' => Location::class,
                    'choice_label' => function ($location) {
                        $name = $location->getName();
                        $city = $location->getCity();

                        return $name.', '.$city;
                    },
                    'label' => 'label.location',
                    'required' => true,
                    'multiple' => false,
                ]
            )
            ->add(
                'play',
                EntityType::class,
                [
                    'class' => Play::class,
                    'choice_label' => function ($play) {
                        $title = $play->getTitle();

                        return $title;
                    },
                    'label' => 'label.play',
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
                'data_class' => Spectacle::class,
                'validation_groups' => 'spectacle-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'spectacle_type'
     */
    public function getBlockPrefix()
    {
        return 'spectacle_type';
    }
}
