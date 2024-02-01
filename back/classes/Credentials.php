<?php
require_once('Database.php');

class Credentials extends Database
{
    private $dataBase;

    public function __construct($_DATABASE_HOST, $_DATABASE_USER, $_DATABASE_PASS, $_DATABASE_NAME)
    {
        parent::__construct($_DATABASE_HOST, $_DATABASE_USER, $_DATABASE_PASS, $_DATABASE_NAME);
        $this->dataBase = $this->connectDb();
    }

    public function createSession($id, $username)
    {
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;

        return 'success';
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->dataBase->prepare('SELECT id FROM usuarios WHERE usuario = :usuario AND clave = :clave');
            $stmt->bindValue(':usuario', $username, PDO::PARAM_STR);
            $stmt->bindValue(':clave', sha1($password), PDO::PARAM_STR);
            $stmt->execute();

            $id = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$id) return 'invalid';

            return $this->createSession($id['id'], $username);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        return 'success';
    }
}
