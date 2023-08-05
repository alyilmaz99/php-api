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
            $row['is_available'] = (bool) $row['is_available'];
            $data[] = $row;
        }
        return $data;

    }
    public function create(array $data): string
    {
        $sql = "INSERT INTO product (name,size,is_available)VALUES (:name, :size, :is_available)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":size", $data['size'] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(':is_available', $data['is_available'] ?? false, PDO::PARAM_BOOL);

        $stmt->execute();
        return $this->connection->lastInsertId();
    }

}
