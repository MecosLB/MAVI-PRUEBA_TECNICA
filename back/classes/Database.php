<?php
class Database
{
    private $DATABASE_HOST;
    private $DATABASE_USER;
    private $DATABASE_PASS;
    private $DATABASE_NAME;

    public function __construct($_DATABASE_HOST, $_DATABASE_USER, $_DATABASE_PASS, $_DATABASE_NAME)
    {
        $this->DATABASE_HOST = $_DATABASE_HOST;
        $this->DATABASE_USER = $_DATABASE_USER;
        $this->DATABASE_PASS = $_DATABASE_PASS;
        $this->DATABASE_NAME = $_DATABASE_NAME;
    }

    public function connectDb()
    {
        try {
            return new PDO("mysql:host={$this->DATABASE_HOST};dbname={$this->DATABASE_NAME}", $this->DATABASE_USER, $this->DATABASE_PASS);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function endDb()
    {
        return null;
    }
}
