<?php

namespace App\Controller\Admin;

use App\Entity\Program;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class ProgramCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Program::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('name'),
        ];
    }
}
