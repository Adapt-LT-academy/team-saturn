<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AnimalAdmin extends AbstractAdmin
{
    // configure which fields are displayed on the edit and create actions
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('id', IntegerType::class);
        $formMapper->add('species', TextType::class);
        $formMapper->add('breed', TextType::class);
        $formMapper->add('gender', TextType::class);
        $formMapper->add('price', IntegerType::class);

    }
    // method configures the filters, used to filter and sort the list of models
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('species');
        $datagridMapper->add('breed');
        $datagridMapper->add('gender');
        $datagridMapper->add('price');

    }
    // Here you specify which fields are shown when all models are listed
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('species');
        $listMapper->addIdentifier('breed');
        $listMapper->addIdentifier('gender');
        $listMapper->addIdentifier('price');

    }
}