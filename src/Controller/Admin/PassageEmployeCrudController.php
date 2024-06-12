<?php

namespace App\Controller\Admin;

use App\Entity\PassageEmploye;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class PassageEmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PassageEmploye::class;
    }
public function configureCrud(Crud $crud): Crud
{
    return $crud
        ->setEntityLabelInSingular('Passage Employe')
        ->setEntityLabelInPlural('Passages Employes')
        ->setPageTitle('index', 'passage de l\'employé')
        ->setPaginatorPageSize(5);
}

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('race'),
            TextField::new('nourriture'),
            TextField::new('quantite'),
            DateField::new('date'),
            TimeField::new('heure'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::NEW, 'ROLE_USER2')
            ->setPermission(Action::DELETE, 'ROLE_USER2')
            ->setPermission(Action::EDIT, 'ROLE_USER2')
            ->disable(Action::DELETE, 'ROLE_ADMIN');
    }
}
