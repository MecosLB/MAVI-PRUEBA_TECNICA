<?php
require_once('Database.php');

class UsersCrud extends Database
{
    private $dataBase;

    public function __construct($_DATABASE_HOST, $_DATABASE_USER, $_DATABASE_PASS, $_DATABASE_NAME)
    {
        parent::__construct($_DATABASE_HOST, $_DATABASE_USER, $_DATABASE_PASS, $_DATABASE_NAME);
        $this->dataBase = $this->connectDb();
    }

    public function createUser($name, $lastName, $address, $email)
    {
        try {
            $stmt = $this->dataBase->prepare('INSERT INTO clientes (nombre, apellido, domicilio, correo) VALUES (:nombre, :apellido, :domicilio, :correo)');
            $stmt->bindValue(':nombre', $name, PDO::PARAM_STR);
            $stmt->bindValue(':apellido', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':domicilio', $address, PDO::PARAM_STR);
            $stmt->bindValue(':correo', $email, PDO::PARAM_STR);
            $stmt->execute();

            return 'success';
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllUsers()
    {
        try {
            $stmt = $this->dataBase->prepare('SELECT * FROM clientes ORDER BY id ASC');
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function editUser($id, $name, $lastName, $address, $email,)
    {
        try {
            $stmt = $this->dataBase->prepare('UPDATE clientes SET nombre = :nombre, apellido = :apellido, domicilio = :domicilio, correo = :correo WHERE id = :id');
            $stmt->bindValue(':nombre', $name, PDO::PARAM_STR);
            $stmt->bindValue(':apellido', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':domicilio', $address, PDO::PARAM_STR);
            $stmt->bindValue(':correo', $email, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            return 'success';
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteUser($id)
    {
        try {
            $stmt = $this->dataBase->prepare('DELETE FROM clientes WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            return 'success';
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
