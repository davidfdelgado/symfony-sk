<?php
	// src/AppBundle/Form/ArtikelABZeitenType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
	use AppBundle\Entity\ArtikelAbZeiten;
	use AppBundle\Entity\ArtikelKategorieArt;
	use AppBundle\Entity\ArtikelKategorieLeistungen;
	use AppBundle\Entity\ArtikelOrte;
	use AppBundle\Entity\ShopKunde;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TimeType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\FormInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Validator\Constraints\IsTrue;

	class ArtikelABZeitenType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder
				->add('aAbStatus', ChoiceType::class, array('label' => 'Bezeichnung', 'choices' => ['inaktiv' => 0, 'aktiv' => 1]))
				->add('aAbTyp', ChoiceType::class, array('label' => 'Typ', 'choices' => ['includieren' => 1, 'excludieren' => 2]))
				->add('aAbDatum', DateTimeType::class,  array('label' => 'Datum', 'date_widget' => 'single_text', 'time_widget' => 'single_text'))
				->add('aAbInterval', TimeType::class,  array('label' => 'Interval'))
				->add('aAbInfo', TextType::class,  array('label' => 'Bezeichnung', 'attr' => ['placeholder' => '']))
				;
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => ArtikelAbZeiten::class,
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new ArtikelAbZeiten(
						$form->get('aAbStatus')->getData(),
						$form->get('aAbTyp')->getData(),
						$form->get('aAbDatum')->getData(),
						$form->get('aAbInterval')->getData(),
						$form->get('aAbInfo')->getData()
					);

					return $vertrieb;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'artikel_ab_zeiten';
	    }
	}