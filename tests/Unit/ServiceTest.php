<?php

namespace App\Tests\Unit;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ServiceTest extends KernelTestCase
{
    public function getEntity() : Service
    {
        return (new Service())
            ->setName('Service #1')
            ->setDescription('Description #1')
            ->setIsFavorite(true);
    }
    public function testEntityIsValid(): void
    {
      self::bootKernel();
      $container = static::getContainer();

      $service = $this->getEntity();

      $errors = $container->get('validator')->validate($service);

      $this->assertCount(2, $errors);
    }

    public function testInvalidName()
    {
        self::bootKernel();
        $container = static::getContainer();

        $service = $this->getEntity();
        $service->setName('');

        $errors = $container->get('validator')->validate($service);
        $this->assertCount(2, $errors);

    }
}
