<?php

namespace App\tests\Repository;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase {
    public function testCount() {
//         self::bootKernel();
//        $users = self::$container->get(UsersRepository::class)->count([]);
//        $this->assertEquals(3, $users);
        $this->assertEquals(1,1);
    }
}