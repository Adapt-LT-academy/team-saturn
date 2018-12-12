<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018-12-12
 * Time: 12:36
 */

// src/Admin/CategoryAdmin.php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AnimalAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('species', TextType::class);
        $formMapper->add('breed', TextType::class);
        $formMapper->add('gender', TextType::class);
        $formMapper->add('price', IntegerType::class);

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('species');
        $datagridMapper->add('breed');
        $datagridMapper->add('gender');
        $datagridMapper->add('price');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('species');
        $listMapper->addIdentifier('breed');
        $listMapper->addIdentifier('gender');
        $listMapper->addIdentifier('price');

    }
}