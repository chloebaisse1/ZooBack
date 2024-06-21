<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
          ->setEntityLabelInSingular( 'Horaire')
          ->setEntityLabelInPlural( 'Horaires' )
          ->setPageTitle('index', 'Arcadia Zoo - Administration des horaires');
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('date', 'Date'),
            TextField::new('heure', 'Heure_debut'),
            TextField::new('heure', 'Heure_fin'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_ADMIN')

            ->disable(Action::EDIT, 'ROLE_USER1','ROLE_USER2')
            ->disable(Action::DELETE, 'ROLE_USER1', 'ROLE_USER2')
            ->disable(Action::NEW, 'ROLE_USER1', 'ROLE_USER2');

    }
}
