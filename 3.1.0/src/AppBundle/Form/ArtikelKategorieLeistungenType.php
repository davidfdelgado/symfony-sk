<?php
	// src/AppBundle/Form/AgenturVertriebType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
	use AppBundle\Entity\ArtikelKategorieArt;
	use AppBundle\Entity\ArtikelKategorieLeistungen;
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

	class ArtikelKategorieLeistungenType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder
				->add('aklBezeichnung', TextType::class,  array('label' => 'Bezeichnung', 'attr' => ['placeholder' => '']))
				->add('aklKl', EntityType::class, array('class' => 'AppBundle\Entity\KategorieLeistungen', 'choice_label' => 'klLabel', 'label' => 'IconSet'))
				;
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => ArtikelKategorieLeistungen::class,
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new ArtikelKategorieLeistungen(
						$form->get('aklBezeichnung')->getData(),
						$form->get('aklKl')->getData()
					);

					return $vertrieb;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'artikel_kategorie_leistungen';
	    }
	}