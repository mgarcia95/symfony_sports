<?php
namespace App\Form;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // ->add('date', DateType::class)
            ->add('date', DateTimeType::class, array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'html5' => false,
                'required' => true
            ))
            ->add('place', TextType::class, array('label' => false))
            ->add('sport', TextType::class, array('label' => false))
            ->add('comments', TextType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Event::class,
        ));
    }
}
