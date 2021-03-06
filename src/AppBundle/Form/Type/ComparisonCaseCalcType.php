<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComparisonCaseCalcType extends AbstractType
{


    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('citypair')
            ->add('cost')
            ->add('time')
            ->add('route')
            ->add('case', 'entity', array(
                'read_only' => true,
                'class' => 'AppBundle:ComparisonCase',
                'query_builder' => function(EntityRepository $entityRepository) use ($options) {
                    return $entityRepository->createQueryBuilder('c')
                        ->where('c.id = :id')
                        ->setParameter('id', $options['case']);
                },
            ))
            ->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
                $data = $event->getData();
                if (isset($data['route'])) {
                    $data['route'] = trim(preg_replace('/\s+/', ' ', $data['route']));
                }
                $event->setData($data);
            })
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ComparisonCaseCalc',
            'case' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_comparisoncasecalc';
    }
}
