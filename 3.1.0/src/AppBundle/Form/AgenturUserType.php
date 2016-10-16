<?php
	// src/AppBundle/Form/AgenturUserType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\Form\FormInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class AgenturUserType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder->add('auBn', TextType::class,  array('label' => 'Benutzername', 'attr' => ['placeholder' => 'm.mustermann']))
	        		->add('auVorname', TextType::class,  array('label' => 'Vorname', 'attr' => ['placeholder' => 'Max']))
					->add('auNachname', TextType::class, array('label' => 'Nachname', 'attr' => ['placeholder' => 'Mustermann']))
					->add('auArt', ChoiceType::class, array('label' => 'Art', 'choices' => ['Anmelder' => ['Normal' => 1, 'Admin' => 2], 'Scanner' => ['Scanner' => 3]]))
					->add('auPw', RepeatedType::class, array(
						'type' => PasswordType::class,
						'first_name' => 'password', 
						'first_options' => array('label' => 'Passwort', 'attr' => ['placeholder' => '******']),
						'second_name' => 'repeat_password', 
						'second_options' => array('label' => 'Passwort wiederholung', 'attr' => ['placeholder' => '******']),
						'invalid_message' => 'Die beiden angegebenen Passwörter stimmen nicht überein.',
						'required' => false,
						'label' => 'Passwort'))
					->add('auStatus', ChoiceType::class, array('choices' => array('aktiv' => true, 'inaktiv' => false), 'label' => 'Status'))
					->add('auEmail', EmailType::class, array('label' => 'Email', 'attr' => ['placeholder' => 'max@mustermann.de']))
					->add('abbruch', SubmitType::class, array('attr' => array('class' => 'btn btn-warning pull-left'), 'label' => ' Abbruch'))
					->add('speichern', SubmitType::class, array('attr' => array('class' => 'btn btn-primary pull-right')));
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => AgenturUser::class,
				'empty_data' => function (FormInterface $form) {
					$user = new AgenturUser(
						$form->get('auBn')->getData(),
						$form->get('auVorname')->getData(),
						$form->get('auNachname')->getData(),
						$form->get('auPw')->getData(),
						$form->get('auEmail')->getData(),
						$form->get('auStatus')->getData()
					);

					return $user;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'agenturuser';
	    }
	}