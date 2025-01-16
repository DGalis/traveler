<?php

namespace classes;
require_once __DIR__ . '/Dbconnection.php';

use classes\Dbconnection;

class City extends Dbconnection
{
    public function getCities(): array
    {
        $sql = "SELECT id, city FROM destination ORDER BY city ASC";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
?>