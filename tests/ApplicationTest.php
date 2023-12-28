<?php

namespace Test;

use App\Kernel\Request;
use App\Kernel\Router;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class ApplicationTest extends TestCase
{
    public function testNewValidUser()
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->setUrl('/user/new');

        $request->setParameters(
            array(
                'nombre' => 'Pablo',
                'password' => 'password',
                'email' => 'pablo@gmail.com'
            )
        );

        $router = new Router();
        $router->register('routes.php');
        $router->resolve($request);

        $userRepository = new UserRepository();
        $existeUsuario = count($userRepository->findUser('Pablo', 'pablo@gmail.com')) > 0 ? true : false;
        $this->assertTrue($existeUsuario);
        $this->expectOutputString('Usuario Pablo registrado');

    }

    public function testNewInvalidUser()
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->setUrl('/user/new');

        $request->setParameters(
            array(
                'nombre' => '',
                'password' => '',
                'email' => ''
            )
        );

        $router = new Router();
        $router->register('routes.php');
        $router->resolve($request);
        $this->expectOutputString('Por favor complete todos los campos obligatorios.');
    }
}