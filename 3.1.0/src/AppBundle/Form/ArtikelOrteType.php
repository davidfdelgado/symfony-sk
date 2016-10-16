<?php
	// src/AppBundle/Form/AgenturVertriebType.php
		
	namespace AppBundle\Form;
	
	use AppBundle\Entity\AgenturUser;
	use AppBundle\Entity\AgenturVertrieb;
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

	class ArtikelOrteType extends AbstractType
	{
	    public function buildForm(FormBuilderInterface $builder, array $options)
	    {
		    	    
	        $builder->add('aOName', TextType::class,  array('label' => 'Bezeichnung', 'attr' => ['placeholder' => 'Münchhausen']))
	        		->add('aONameKurz', TextType::class,  array('label' => 'Kürzel', 'attr' => ['placeholder' => 'MHA']))
	        		->add('aOBewerten', CheckboxType::class,  array('label' => 'Können Kategorien aus dieser Destination bewertet werden?', 'attr' => ['placeholder' => '']))
					->add('delete', SubmitType::class, array('attr' => array('class' => 'btn btn-danger'), 'label' => ' Löschen'))
					->add('delete_text', TextType::class, array('mapped' => false))
					->add('abort', SubmitType::class, array('attr' => array('class' => 'btn btn-warning'), 'label' => ' Abbruch'))
					->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-primary pull-right btn-big fa fa-save'), 'label' => ' speichern'));
	    }
	
	    public function configureOptions(OptionsResolver $resolver)
	    {
	        $resolver->setDefaults(array(
	            'data_class' => ArtikelOrte::class,
				'empty_data' => function (FormInterface $form) {
					$vertrieb = new ArtikelOrte(
						$form->get('aOName')->getData(),
						$form->get('aONameKurz')->getData(),
						$form->get('aOBewerten')->getData()
					);

					return $vertrieb;
				}
	        ));
	    }

	    public function getName()
	    {
	        return 'artikel_orte';
	    }
	}