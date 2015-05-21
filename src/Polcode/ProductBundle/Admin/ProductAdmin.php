<?php

namespace Polcode\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Description of CategoryAdmin
 *
 * @author Lukasz Malicki
 * @date May 20, 2015
 */
class ProductAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Provide product name'))
            ->add('description', 'textarea', array('label' => 'Provide product description'))
            ->add('price')
            ->add('category', 'sonata_type_model_list' , [],
                        [ 'placeholder' => 'Select product category' ]
                    );
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('price')
            ->add('category.name');
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('id')
                ->add('name')
                ->add('price')
                ->add('description')
                ->add('slug')
                ->add('category.name')
        ;
    }
}