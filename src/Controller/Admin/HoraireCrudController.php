<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use Doctrine\DBAL\Types\TimeImmutableType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Horaire du zoo')
            ->setEntityLabelInPlural('Horaires du zoo')
            ->setPageTitle('index', 'Arcadia Zoo - Administration des Horaires');

    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('jour'),
            TimeField::new('Ouverture'),
            TimeField::new('Fermeture'),
        ];
    }
}

