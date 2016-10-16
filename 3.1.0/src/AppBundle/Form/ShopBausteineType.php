<?php
	// src/AppBundle/Form/AgenturVertriebType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
	use AppBundle\Entity\ArtikelKategorieArt;
	use AppBundle\Entity\ArtikelOrte;
	use AppBundle\Entity\ShopBausteine;
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
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\FormInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Validator\Constraints\IsTrue;

	class ShopBausteineType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder->add('hArt', ChoiceType::class,  array('label' => 'Baustein Art', 'choices' => array('AngebotsBaustein' => 1, 'Voucher' => 2, 'HinweisText' => 3), 'placeholder' => 'Bitte auswählen'))
	        		->add('hName', TextType::class,  array('label' => 'Name', 'attr' => ['placeholder' => 'Name']))
	        		->add('hText', TextareaType::class,  array('label' => 'Inhalt', 'attr' => ['placeholder' => 'Inhaltstext']))
	        		->add('hTextEn', TextareaType::class,  array('label' => 'Inhalt (Eng)', 'attr' => ['placeholder' => 'Inhaltstext auf Englisch']))
	        		->add('hHinweis', CheckboxType::class,  array('label' => 'Gruppenhinweis für Voucher' ))
					->add('delete', SubmitType::class, array('attr' => array('class' => 'btn btn-danger pull-left'), 'label' => ' Löschen'))
					->add('abort', SubmitType::class, array('attr' => array('class' => 'btn btn-warning pull-left'), 'label' => ' Abbruch'))
					->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-primary pull-right btn-big fa fa-save'), 'label' => ' Speichern'));
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => ShopBausteine::class,
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new ShopBausteine(
						$form->get('hArt')->getData(),
						$form->get('hName')->getData(),
						$form->get('hNameEn')->getData(),
						$form->get('hText')->getData(),
						$form->get('hTextEn')->getData(),
						$form->get('hHinweis')->getData()
					);

					return $vertrieb;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'shop_bausteine';
	    }
	}