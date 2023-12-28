<?php

namespace App\Http\Controllers;

use App\Kernel\Request;
use App\Kernel\Response;
use App\Repository\UserRepository;
use Exception;

class UserController
{
    public static function userNew(Request $request)
    {
        try {
            $params = $request->getParameters();
            $nombre = $params['nombre'];
            $password = $params['password'];
            $email = $params['email'];
            
            if (empty($nombre) || empty($password) || empty($email)) {
                Response::httpResponse(422, 'Por favor complete todos los campos obligatorios.');
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Response::httpResponse(422, 'Por favor ingrese un correo electrónico válido.');
                return;
            }
            
            $repository = new UserRepository();
            $existeUsuario = count($repository->findUser($nombre, $email)) > 0 ? true : false;

            if ($existeUsuario) {
                Response::httpResponse(422, 'Ya existe un usuario con el email y nombre seleccionados.');
                return;
            }

            $hashedPasword = password_hash($params['password'], PASSWORD_DEFAULT);

            $repository->newUser($params['nombre'], $hashedPasword, $params['email']);
            Response::httpResponse(200, "Usuario $params[nombre] registrado");
            return;
        }
        catch (Exception $e) {
            Response::httpResponse(500, "No es posible registrar el nuevo usuario");
            return;
        }
    }
}