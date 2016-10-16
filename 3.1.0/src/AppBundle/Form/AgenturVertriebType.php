<?php
	// src/AppBundle/Form/AgenturVertriebType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
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

	class AgenturVertriebType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder->add('avHotelname', TextType::class,  array('label' => 'Hotel-/Agenturname', 'attr' => ['placeholder' => '']))
	        		->add('avAnsprechpartner', TextType::class,  array('label' => 'Ansprechpartner', 'attr' => ['placeholder' => '']))
					->add('avKid', ShopKundeType::class, array('error_bubbling' => true))
					->add('avUsers', AgenturUserType::class, array('error_bubbling' => true))
					->add('agb', CheckboxType::class, [ 'label' => 'Ich habe die Allgemeine Geschäftsbedingungen gelesen und akzeptiere diese.', 'mapped' => false, 'required' => true, 'constraints'=>new IsTrue(array('message'=>'Die AGB müssen akzeptiert werden.'))] )
					->add('abbruch', SubmitType::class, array('attr' => array('class' => 'btn btn-warning pull-left'), 'label' => ' Abbruch'))
					->add('registrieren', SubmitType::class, array('attr' => array('class' => 'btn btn-primary pull-right btn-big fa fa-send-o'), 'label' => ' Registrierung abschließen'));
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => AgenturVertrieb::class,
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new AgenturVertrieb(
						$form->get('avHotelname')->getData(),
						$form->get('avAnsprechpartner')->getData(),
						$form->get('avKid')->getData(),
						$form->get('avUsers')->getData()
					);

					return $vertrieb;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'agentur_vertrieb';
	    }
	}