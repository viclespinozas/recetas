<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

final class RecipesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('preparation')
            ->add('image')
            ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('image', null, [
                'template' => 'recipes_image.html.twig'
            ])
            ->add('name')
            ->add('preparation')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('preparation')
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
                // 'image_uri' => true,
                'delete_label' => 'Eliminar',
            ])
            ->add('ingredients', CollectionType::class, [
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'delete_options' => [
                            // You may otherwise choose to put the field but hide it
                            'type'         => HiddenType::class,
                            // In that case, you need to fill in the options as well
                            'type_options' => [
                                'mapped'   => false,
                                'required' => false,
                            ]
                        ]
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ])
            ->add('preparationImages', CollectionType::class, [
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'delete_options' => [
                            // You may otherwise choose to put the field but hide it
                            'type'         => HiddenType::class,
                            // In that case, you need to fill in the options as well
                            'type_options' => [
                                'mapped'   => false,
                                'required' => false,
                            ]
                        ]
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('preparation')
            ->add('image')
            ;
    }

    /**
     * @param  \App\Entity\WorkReport $object
    */
    public function prePersistOrUpdate($object)
    {
        $now = new \DateTime();
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        if (count($object->getIngredients()) > 0) {
            foreach ($object->getIngredients() as $ingredient) {
                $ingredient->setRecipes($object);
            }
        }

        $object->setCreatedAt($now);
    }

    /**
     * @param  \App\Entity\Recipes $object
     */
    public function prePersist($object)
    {
        $this->prePersistOrUpdate($object);
    }

    /**
     * @param  \App\Entity\Recipes $object
     */
    public function preUpdate($object)
    {
        $this->prePersistOrUpdate($object);
    }
}
