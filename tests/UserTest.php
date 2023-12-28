<?php

namespace Test;

use App\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function testGetId()
    {
        $this->createUser();
        $this->assertEquals(1, $this->user->getId());
    }

    public function testGetNombre()
    {
        $this->createUser();
        $this->assertEquals('Pablo', $this->user->getNombre());
    }

    public function testGetPassword()
    {
        $this->createUser();
        $this->assertTrue(password_verify('password', $this->user->getPassword()));
    }

    public function testGetEmail()
    {
        $this->createUser();
        $this->assertEquals('pablo@gmail.com', $this->user->getEmail());
    }

    public function testIsHabilitado()
    {
        $this->createUser();
        $this->assertEquals(true, $this->user->isHabilitado());
    }

    public function testSetId()
    {
        $this->createUser();
        $retorno = $this->user->setId(2);
        $this->assertEquals(2, $this->user->getId());
        $this->assertInstanceOf(User::class, $retorno);
    }

    public function testSetNombre()
    {
        $this->createUser();
        $retorno = $this->user->setNombre('Nombre');
        $this->assertEquals('Nombre', $this->user->getNombre());
        $this->assertInstanceOf(User::class, $retorno);
    }
    
    public function testSetPassword()
    {
        $this->createUser();
        $retorno = $this->user->setPassword(password_hash('password', PASSWORD_DEFAULT));
        $this->assertTrue(password_verify('password', $this->user->getPassword()));
        $this->assertInstanceOf(User::class, $retorno);
    }

    public function testSetEmail()
    {
        $this->createUser();
        $retorno = $this->user->setEmail('nombre@gmail.com');
        $this->assertEquals('nombre@gmail.com', $this->user->getEmail());
        $this->assertInstanceOf(User::class, $retorno);
    }

    public function testSetHabilitado()
    {
        $this->createUser();
        $retorno = $this->user->setHabilitado(false);
        $this->assertEquals(false, $this->user->isHabilitado());
        $this->assertInstanceOf(User::class, $retorno);
    }

    public function testUserConstructor()
    {
        $this->createUser();
        $this->assertInstanceOf(User::class, $this->user);
    }

    private function createUser()
    {
        $this->user = new User(1, 'Pablo', password_hash('password', PASSWORD_DEFAULT), 'pablo@gmail.com', true);
    }
}