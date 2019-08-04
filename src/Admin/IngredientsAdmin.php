<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class IngredientsAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('image', null, [
                'template' => 'recipes_image.html.twig'
            ])
            ->add('name')
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
        $formMapper
            ->add('name')
            ->add('imageFile', VichImageType::class, [
                // 'constraints' => array(
                //     new Image( array('mimeTypes'=>
                //         array(
                //           'image/jpeg',
                //           'image/png',
                //           'image/jpg',
                //           'image/gif',
                //         ),
                //         'maxSize' => '20M' 
                //         )), 
                        
                // ),
                'required' => true,
                'allow_delete' => true,
                'download_label' => 'Descargar',
                'download_uri' => true,
                'image_uri' => true,
                'delete_label' => 'Eliminar',
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('image')
        ;
    }
}
