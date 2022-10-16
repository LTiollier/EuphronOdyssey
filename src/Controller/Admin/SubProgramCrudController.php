<?php

namespace App\Controller\Admin;

use App\Entity\SubProgram;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class SubProgramCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubProgram::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('name'),
            AssociationField::new('program')->autocomplete(),
        ];
    }
}
