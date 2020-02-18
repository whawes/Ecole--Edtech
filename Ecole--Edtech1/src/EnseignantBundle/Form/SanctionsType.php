<?php

namespace EnseignantBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SanctionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date_sanction')->add('raisonsanction', ChoiceType::class, [
            'choices'  => [
                'Bavardage' => "Bavardage",
                'Indiscipline' => "Indiscipline",
                'Travail non fait' => "Travail non fait",
                'Retards répétés' => "Retards répétés",
            ],
        ])->add('eleve', EntityType::class, [
            'class' => 'AppBundle:User', 'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->where('u.roles = :role')
                    ->setParameter('role', 'a:1:{i:0;s:10:"ROLE_ELEVE";}');
            }])->add('punition', ChoiceType::class, [
            'choices'  => [
                'Observation' => "Observation",
                'Retenue' => "Retenue",
                'Avertissement' => "Avertissement",
            ],
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EnseignantBundle\Entity\Sanctions'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'enseignantbundle_sanctions';
    }


}
