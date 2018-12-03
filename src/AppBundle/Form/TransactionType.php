<?php
/**
 * Transaction type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Transaction;
use AppBundle\Entity\Collection;
use AppBundle\Entity\PaymentMethod;
use AppBundle\Entity\Status;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Class TransactionType.
 *
 */
class TransactionType extends AbstractType
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
                'paymentmethod',
                EntityType::class,
                [
                    'class' => PaymentMethod::class,
                    'choice_label' => function ($paymentmethod) {
                        $name = $paymentmethod->getName();

                        return $name;
                    },
                    'label' => 'label.paymentmethod',
                    'required' => true,
                    'multiple' => false,
                ]
            )
            ->add(
                'collection',
                EntityType::class,
                [
                    'class' => Collection::class,
                    'choice_label' => function ($collection) {
                        $name = $collection->getName();

                        return $name;
                    },
                    'label' => 'label.collection',
                    'required' => true,
                    'multiple' => false,
                ]
            )
            ->add(
                'status',
                EntityType::class,
                [
                    'class' => Status::class,
                    'choice_label' => function ($status) {
                        return $status->getName();
                    },
                    'placeholder' => false,
                    'label' => 'label.status.change',
                    'required' => true,
                    'multiple' => false,
                            ]
            )
            ->add(
                'numberOfTickets',
                IntegerType::class,
                [
                    'label' => 'label.numberOfTickets',
                    'required' => true,
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
                'data_class' => Transaction::class,
                'validation_groups' => 'transaction-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'transaction_type'
     */
    public function getBlockPrefix()
    {
        return 'transaction_type';
    }
}
