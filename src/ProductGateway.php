<?php

class ProductGateway
{
    private PDO $connection;
    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->connection->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;

    }

}
