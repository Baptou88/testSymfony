<?php

namespace App\tests\Repository;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase {
    public function testCount() {
        $kernel = self::bootKernel();
        $users = self::$container->get(UsersRepository::class)->count([]);
        $this->assertEquals(1, $users);
    }
}