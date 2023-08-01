<?php

class Database
{
    protected string $host;
    protected string $name;
    protected string $user;
    protected string $password;
    public function __construct(
        string $host,
        string $name,
        string $user,
        string $password) {

        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";
        return new PDO($dsn, $this->user, $this->password);
    }

}