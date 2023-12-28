<?php

namespace App\Repository;

use App\Drivers\MySqlDriver;

class UserRepository
{
    use MySqlDriver;

    public function findUser($nombre, $email)
    {
        $this->connect();
        
        $stmt = $this->conn->prepare("SELECT id FROM users
            WHERE nombre = :nombre AND email = :email");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $resultados = $stmt->fetchAll();
        
        $this->disconnect();
        
        return $resultados;
    }

    public function newUser($nombre, $password, $email)
    {
        $this->connect();
        
        $stmt = $this->conn->prepare("INSERT INTO users (nombre, password, email, habilitado) 
            VALUES (:nombre, :password, :email, true)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $this->disconnect();
    }

    public function editUser($userId, $nombre, $password, $email)
    {
        $this->connect();

        $stmt = $this->conn->prepare("UPDATE users 
            SET nombre = :nombre, password = :password, email = :email
            WHERE id = :userId");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $this->disconnect();
    }

    public function deleteUser($userId)
    {
        $this->connect();
        
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $this->disconnect();
    }
}