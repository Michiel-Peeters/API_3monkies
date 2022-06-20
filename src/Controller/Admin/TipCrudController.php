<?php

namespace App\Controller\Admin;

use App\Entity\Tip;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tip::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
          AssociationField::new("room"),
            TextField::new("description"),
        ];
    }

}
