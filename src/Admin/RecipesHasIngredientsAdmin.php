<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class RecipesHasIngredientsAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('_action', null, [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $object = $this->getSubject();
        $ingredients = array();

        if ($object && $object->getIngredients() != NULL) {
            $ingredients = $object->getIngredients();
        }

        $formMapper
            ->add('ingredients', EntityType::class, array(
                'class'    => 'App:Ingredients',
                'multiple' => false,
                'required' => false,
                'data' => $ingredients,
                // 'constraints' => array(
                //     new NotBlank(), 
                // ),
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
        ;
    }
}
