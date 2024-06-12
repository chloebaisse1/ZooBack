<?php

namespace App\Controller\Admin;

use App\Entity\ComptesRendusVeto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ComptesRendusVetoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ComptesRendusVeto::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Comptes rendus')
            ->setEntityLabelInSingular('Compte rendu')
            ->setPageTitle('index', 'Arcadia Zoo - comptes rendus vétérinaire')
            ->setPaginatorPageSize(5);
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('prenom'),
            TextField::new('race'),
            TextField::new('etat'),
            TextField::new('nourriture'),
            TextField::new('quantite'),
            DateField::new('passage'),
            TextEditorField::new('detail'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::NEW, 'ROLE_USER1')
            ->setPermission(Action::DELETE, 'ROLE_USER1')
            ->setPermission(Action::EDIT, 'ROLE_USER1')
            ->disable(Action::DELETE, 'ROLE_ADMIN');
    }
}
