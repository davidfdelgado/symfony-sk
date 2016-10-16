<?php
	// src/AppBundle/Form/VBVorgaengeAbfrageType.php
		
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
	
	class VBVorgaengeAbfrageType extends AbstractType
	{
		public function __construct($overview = null)
		{
			$this->overview = $overview;
		}

		public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder->add('monate', ChoiceType::class,  array('label' => 'Zeitraum', 'attr' => []))
	        		->add('benutzer', ChoiceType::class,  array('label' => 'Benutzer', 'attr' => []));

	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	    }

	    public function getName()
	    {
	        return 'VB_Vorgaenge_Abfrage';
	    }
	}