<?php

namespace App\Controller\Admin;

use App\Entity\Training;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class TrainingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Training::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('date'),
            AssociationField::new('user')->autocomplete(),
            AssociationField::new('subProgram')->autocomplete(),
        ];
    }
}
