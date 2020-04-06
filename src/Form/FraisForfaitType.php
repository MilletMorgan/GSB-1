<?php

namespace App\Form;

use App\Entity\FraisForfait;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FraisForfaitType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('label', null, array(
				'attr' => array(
					'class' => 'form-control'
				)
			))
			->add('prix', null, array(
				'attr' => array(
					'class' => 'form-control'
				)
			));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => FraisForfait::class,
		]);
	}
}
