<?php
	// src/AppBundle/Form/AgenturVertriebType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
	use AppBundle\Entity\ArtikelKategorie;
	use AppBundle\Entity\ArtikelKategorieArt;
	use AppBundle\Entity\ArtikelOrte;
	use AppBundle\Entity\ShopKunde;
	use Doctrine\ORM\EntityRepository;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TimeType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\FormInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Validator\Constraints\IsTrue;

	class ArtikelKategorieType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {

	        $builder
				->add('aKAktiv', ChoiceType::class,  array('label' => 'Aktiv', 'choices' => array('inaktiv' => 0, 'aktiv' => 1), 'attr' => ['placeholder' => '']))
				->add('aKBewerten', CheckboxType::class,  array('label' => 'Kann diese Leistung bewertet werden?', 'attr' => ['placeholder' => '']))
				->add('aKAnsicht', ChoiceType::class,  array('label' => 'Wie wird die Leistung in der BackendÜbersicht dargestellt?', 'choices' => ["garnicht" => 0, "Zusammengefasst" => 1, "Einzeln" => 2]))
				->add('aKVertrieb', CheckboxType::class,  array('label' => 'Soll die Leistung im Vertrieb angezeigt werden?', 'attr' => ['placeholder' => '']))
				->add('aKDruck', CheckboxType::class,  array('label' => 'Kann der Voucher auch Mobil eingelöst werden?', 'attr' => ['placeholder' => '']))
				->add('aKVoucher', ChoiceType::class,  array('label' => 'Soll hier ein Voucher erstellt werden?', 'choices' => ["Normal generieren" => 1, "Voucher wird per Email verschickt (Hinweis drucken)" => 2, 'Keinen Voucher generieren' => 0], 'attr' => ['placeholder' => '', 'class' => 'checkVoucher']))
				->add('aKArt', EntityType::class,  array('class' => 'AppBundle\Entity\ArtikelKategorieArt', 'choice_label' => 'aABeschreibung', 'label' => 'Kategorie-Art', 'attr' => ['placeholder' => '']))
				->add('aKZusatz', EntityType::class,  array('class' => 'AppBundle\Entity\KategorieZusatz', 'choice_label' => 'akzBeschreibung', 'label' => 'Kategorie-Art', 'attr' => ['placeholder' => '']))
				->add('aKEinbuchen', CheckboxType::class,  array('label' => 'Muss die Leistung eingebucht werden?', 'attr' => ['placeholder' => '']))
				->add('aKName', TextType::class,  array('label' => 'Name (DE)', 'attr' => ['placeholder' => '']))
				->add('aKNameEn', TextType::class,  array('label' => 'Name (EN)', 'attr' => ['placeholder' => '']))
				->add('aKBeschreibung', TextareaType::class,  array('label' => 'Beschreibung (DE)', 'attr' => ['placeholder' => '']))
				->add('aKBeschreibungEn', TextareaType::class,  array('label' => 'Beschreibung (EN)', 'attr' => ['placeholder' => '']))
				->add('aKNameKurz', TextType::class,  array('label' => 'Kürzel', 'attr' => ['placeholder' => 'ABC']))
				->add('aKUeberschrift', TextType::class,  array('label' => 'Überschrift (DE)', 'attr' => ['placeholder' => '']))
				->add('aKUeberschriftEn', TextType::class,  array('label' => 'Überschrift (EN)', 'attr' => ['placeholder' => '']))
				->add('aKKonto', TextType::class,  array('label' => 'Konto (BuHa)', 'attr' => ['placeholder' => '4000']))
				->add('aKDauer', TimeType::class,  array('label' => 'Dauer', 'attr' => ['placeholder' => '00:00:00']))
				->add('aKTime', ChoiceType::class,  array('label' => 'Muss ein Datum angegeben werden?', 'choices' => ["Nein" => 0, "Datum muss hinterlegt werden" => 9]))
				->add('aKTimeMinDate', ChoiceType::class,  array('label' => 'Tage bis Buchung', 'choices' => ['am selbern Tag' => 0, "+1 Tag" => 1, "+2 Tage" => 2, "+3 Tage" => 3 ], 'attr' => ['placeholder' => '0 - 10']))
				->add('aKMwst', ChoiceType::class,  array('label' => 'Mehrwertsteuer (%)', 'choices' => ['7 %' => 7, "19 %" => 19] ))
				->add('aKPoints', CollectionType::class, array('entry_type' => ArtikelKategorieLeistungenType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true, 'prototype_name' => '__opt_prot__'))
				->add('aKZeiten', CollectionType::class, array('entry_type' => ArtikelABZeitenType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true, 'prototype_name' => '__opt_prot__'))

				->add('aKVtext',
					EntityType::class,
					array(
						'label' => 'Baustein für Voucher',
						'class'=> 'AppBundle\Entity\ShopBausteine',
						'query_builder' => function(EntityRepository $repository) {
							$qb = $repository->createQueryBuilder('u');
							return $qb
								->where('u.hArt = 2')
							;
						},
						'choice_label' => 'hName',
						'placeholder' => "- VoucherBaustein auswählen -"
						)
					)
				->add('aKRtext',
					EntityType::class,
					array(
						'label' => 'Baustein für Angebotr',
						'class' => 'AppBundle\Entity\ShopBausteine',
						'query_builder' => function(EntityRepository $repository) {
							$qb = $repository->createQueryBuilder('u');
							return $qb
								->where('u.hArt = 1')
								;
    					},
						'choice_label' => 'hName',
						'placeholder' => "- VoucherBaustein auswählen -"
						)
					)

				->add('delete', SubmitType::class, array('attr' => array('class' => 'btn btn-danger pull-left'), 'label' => ' Löschen'))
				->add('abort', SubmitType::class, array('attr' => array('class' => 'btn btn-warning pull-left'), 'label' => ' Abbruch'))
				->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-primary pull-right btn-big fa fa-save'), 'label' => ' Speichern'));
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => ArtikelKategorie::class,
				'attr' => ['class' => 'form-horizontal'],
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new ArtikelKategorie(
						$form->get('')->getData(),
						$form->get('aAOverview')->getData(),
						$form->get('aABeschreibung')->getData(),
						$form->get('aAIcon')->getData(),
						$form->get('aAGoogleMarkerImage')->getData(),
						$form->get('aACssClass')->getData()
					);

					return $vertrieb;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'artikel_kategorie';
	    }
	}