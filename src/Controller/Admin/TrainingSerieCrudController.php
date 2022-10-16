<?php

namespace App\Controller\Admin;

use App\Entity\TrainingSerie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class TrainingSerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TrainingSerie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            AssociationField::new('training')->autocomplete(),
            AssociationField::new('exercise')->autocomplete(),
            Field::new('serie'),
            Field::new('result'),
        ];
    }
}
