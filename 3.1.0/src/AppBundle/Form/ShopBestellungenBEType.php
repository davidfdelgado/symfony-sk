<?php
// src/AppBundle/Form/ShopBestellungenVBType

namespace AppBundle\Form;

use AppBundle\Entity\ShopBestellungen;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class ShopBestellungenBEType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bDatum', DateType::class, ['label' => 'Reisedatum', 'widget' => 'single_text', 'format' => 'dd.MM.yyyy', 'attr' => [ 'class' => 'datepicker', 'placeholder' => 'Reisedatum des Kunden' ]])
            ->add('bRef', TextType::class, ['label' => 'Referenz', 'attr' => [ 'placeholder' => 'Referenz zum Kunden hier eintragen'], 'required' => false] )
            ->add('bArt', ChoiceType::class, ['choices' => ['Deutsch' => 'de-DE', 'Englisch' => 'en-GB'], 'label' => 'Sprache'] )
            ->add('bLang', ChoiceType::class, ['choices' => ['Deutsch' => 'de-DE', 'Englisch' => 'en-GB'], 'label' => 'Sprache'] )
            ->add('close', SubmitType::class, ['attr' => ['class' => 'btn btn-primary'], 'label' => 'schliessen'])
            ->add('sentToMail', EmailType::class, ['attr' => ['class' => 'form-control', 'placeholder' => ' zur StandardAdresse des Kunden'], 'label' => 'schliessen', 'required' => false, 'mapped' => false])
            ->add('sentMail', SubmitType::class, ['attr' => ['class' => 'btn btn-success'], 'label' => ' Mail senden'])
            ->add('speichern', SubmitType::class, ['attr' => ['class' => 'btn btn-success btn-block fa fa-share-square-o'], 'label' => ' Vorgang erstellen'])
            ->add('aktualisieren', SubmitType::class, ['attr' => ['class' => 'btn btn-primary btn-block fa fa-floppy-o'], 'label' => ' aktualisieren / speichern'])
            ->add('abbruch', SubmitType::class, ['attr' => ['class' => 'btn btn-warning pull-left'], 'label' => ' abbruch'])
            ->add('stornieren', SubmitType::class, ['attr' => ['class' => 'btn btn-danger pull-right fa fa-remove'], 'label' => ' stornieren'])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $vorgang = $event->getData();
            $form = $event->getForm();

            if(!$vorgang){
                $form
                    ->add('agb', CheckboxType::class, [ 'label' => 'Ich habe die Allgemeine Geschäftsbedingungen gelesen und akzeptiere diese.', 'mapped' => false, 'required' => true, 'constraints'=>new IsTrue(array('message'=>'Die AGB müssen akzeptiert werden.'))] )
                    ;
            }

        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ShopBestellungen::class,
            'empty_data' => function(FormInterface $form){
                $vorgang = new ShopBestellungen(
                       $form->get('bDatum')->getData(),
                       $form->get('bRef')->getData(),
                       $form->get('bLang')->getData()
                );

                return $vorgang;
            }
        ));
    }

    public function getName()
    {
        return 'shop_bestellungen_be_type';
    }
}
