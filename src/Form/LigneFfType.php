<?php

namespace App\Form;

use App\Entity\LigneFf;
use App\Entity\TypeFF;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneFfType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('dateFFrais', DateType::class, [
				'widget' => 'single_text',
			])
			->add('quantite', IntegerType::class)
			->add('typeFF', EntityType::class, [
				'class' => TypeFF::class
			])
			->add('fraisForfait', CollectionType::class, array(
				'entry_type' => FraisForfaitType::class,
				'allow_add' => true
			));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => LigneFf::class,
		]);
	}
}
