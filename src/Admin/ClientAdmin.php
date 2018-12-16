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

class ClientAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class);
        $formMapper->add('surname', TextType::class);
        $formMapper->add('street', TextType::class);
        $formMapper->add('apartment', IntegerType::class);
        $formMapper->add('city', TextType::class);
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('surname');
        $datagridMapper->add('street');
        $datagridMapper->add('apartment');
        $datagridMapper->add('city');
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('surname');
        $listMapper->addIdentifier('street');
        $listMapper->addIdentifier('apartment');
        $listMapper->addIdentifier('city');
    }
}