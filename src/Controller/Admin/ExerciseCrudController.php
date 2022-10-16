<?php

namespace App\Controller\Admin;

use App\Entity\Exercise;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class ExerciseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercise::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('name'),
            Field::new('series'),
        ];
    }
}
