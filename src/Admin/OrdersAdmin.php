<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OrdersAdmin extends AbstractAdmin
{
    // configure which fields are displayed on the edit and create actions
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('id', IntegerType::class);
        $formMapper->add('client_id', IntegerType::class);
        $formMapper->add('animal_id', IntegerType::class);

    }

    // method configures the filters, used to filter and sort the list of models
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('client_id');
        $datagridMapper->add('animal_id');

    }

    // Here you specify which fields are shown when all models are listed
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('client_id');
        $listMapper->addIdentifier('animal_id');

    }
}