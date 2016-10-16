<?php
// src/AppBundle/Form/ShopKundeType

namespace AppBundle\Form;

use AppBundle\Entity\ShopKunde;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopKundeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kAnrede', ChoiceType::class, ['choices' => ['Bitte auswählen' => null, 'Frau' => 'frau', 'Herr' => 'herr'], 'label' => 'Anrede', 'required' => true])
            ->add('kVorname', TextType::class, ['label' => 'Vorname', 'required' => false, 'attr' => ['placeholder' => 'Vorname']])
            ->add('kNachname', TextType::class, ['label' => 'Nachname', 'required' => true, 'attr' => ['placeholder' => 'Nachname']])
            ->add('kFirma', TextType::class, ['label' => 'Firma', 'required' => false, 'attr' => ['placeholder' => 'Firma']])
            ->add('kStrasse', TextType::class, ['label' => 'Strasse', 'required' => false, 'attr' => ['placeholder' => 'Strasse / Hausnummer']])
            ->add('kPlz', TextType::class, ['label' => 'PLZ', 'required' => false, 'attr' => ['placeholder' => 'PLZ']])
            ->add('kStadt', TextType::class, ['label' => 'Stadt', 'required' => false, 'attr' => ['placeholder' => 'Stadt/Ort']])
            ->add('kTelefonnummer', TextType::class, ['label' => 'Telefonnummer', 'required' => false, 'attr' => ['placeholder' => 'Telefonnummer']])
            ->add('kEmail', EmailType::class, ['label' => 'eMail', 'required' => true, 'attr' => ['placeholder' => 'max@mustermann.de']])
            ->add('kNewsletter', CheckboxType::class, ['label' => 'Soll der Kunde einen Newsletter erhalten?', 'required' => false])
            ->add('kBewertungLink', CheckboxType::class, ['label' => 'Soll der Kunde eine Bewertung abgeben können?', 'required' => false])
            ->add('kChannel', ChoiceType::class, ['choices' => ['- Bitte auswählen -' => null, 'Broschüre' => 'BRO', 'Empfehlung' => 'EMPF', 'Adwords' => 'SEA', 'Radio' => 'RADIO', 'Suchmaschiene' => 'SEO', 'VerkehrsmittelWerbung' => 'VKM', 'GetYourGuide' => 'GYG', 'Groupon' => 'GROUP', 'DailyDeal' => 'DAILY', 'Tripadvisor' => 'TRI'], 'label' => 'Über welchen Kanal ist der Kunde gekommen?', 'required' => false])
            ->add('speichern', SubmitType::class, ['attr' => ['class' => 'btn btn-success']])
            ->add('close', SubmitType::class, ['attr' => ['class' => 'btn btn-primary pull-right'], 'label' => 'abbrechen'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ShopKunde::class,
            'empty_data' => function(FormInterface $form){
                $kunde = new ShopKunde(
                    $form->get('kAnrede')->getData(),
                    $form->get('kVorname')->getData(),
                    $form->get('kNachname')->getData(),
                    $form->get('kFirma')->getData(),
                    $form->get('kStrasse')->getData(),
                    $form->get('kPlz')->getData(),
                    $form->get('kStadt')->getData(),
                    $form->get('kTelefonnummer')->getData(),
                    $form->get('kEmail')->getData(),
                    $form->get('kNewsletter')->getData(),
                    $form->get('kBewertungLink')->getData(),
                    $form->get('kChannel')->getData()
                );
                return $kunde;
            }
        ));
    }

    public function getName()
    {
        return 'shopkundetype';
    }
}
