<?php
	// src/AppBundle/Form/AgenturVertriebType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
	use AppBundle\Entity\ArtikelKategorieArt;
	use AppBundle\Entity\ArtikelOrte;
	use AppBundle\Entity\ShopKunde;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\FormInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Validator\Constraints\IsTrue;

	class ArtikelKategorieArtType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder->add('aATyp', ChoiceType::class,  array('label' => 'Typ', 'choices' => array('inaktiv' => 0, 'aktiv' => 1), 'attr' => ['placeholder' => 'Münchhausen']))
	        		->add('aAOverview', ChoiceType::class,  array('label' => 'Darstellung in der Übersicht?', 'choices' => ['nein' => 0, 'ja' => 1], 'attr' => ['placeholder' => 'MHA']))
	        		->add('aABeschreibung', TextType::class,  array('label' => 'Beschreibung', 'attr' => ['placeholder' => '']))
	        		->add('aACssClass', TextType::class,  array('label' => 'Hintergrundfarbe?', 'attr' => ['placeholder' => 'CSS-Klasse']))
	        		->add('aAGoogleMarkerImage', TextType::class,  array('label' => 'GoogleMapMarker', 'attr' => ['placeholder' => 'Pfad zum Bild']))
	        		->add('aAIcon', TextType::class,  array('label' => 'Font-Icon', 'attr' => ['placeholder' => 'fa-class']))
					->add('delete', SubmitType::class, array('attr' => array('class' => 'btn btn-danger pull-left'), 'label' => ' Löschen'))
					->add('abort', SubmitType::class, array('attr' => array('class' => 'btn btn-warning pull-left'), 'label' => ' Abbruch'))
					->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-primary pull-right btn-big fa fa-save'), 'label' => ' Speichern'));
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => ArtikelKategorieArt::class,
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new ArtikelKategorieArt(
						$form->get('aATyp')->getData(),
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
	        return 'artikel_kategorie_art';
	    }
	}