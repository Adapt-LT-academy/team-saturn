<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PetAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('species', TextType::class);
        $formMapper->add('size', TextType::class);
        $formMapper->add('sex', TextType::class);
        $formMapper->add('image', TextType::class);
        $formMapper->add('price', NumberType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('species');
        $datagridMapper->add('size');
        $datagridMapper->add('sex');
        $datagridMapper->add('image');
        $datagridMapper->add('price');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('species');
        $listMapper->addIdentifier('size');
        $listMapper->addIdentifier('sex');
        $listMapper->addIdentifier('image');
        $listMapper->addIdentifier('price');
    }
}