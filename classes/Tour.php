<?php
namespace classes;
include_once __DIR__ . '/Dbconnection.php';
class Tour extends DBconnection
{
    protected $connection;

    public function __construct()
    {
        parent::__construct();// Volá konštruktor triedy DBconnection, nevytváram inštanciu triedy ale dedím vlastnosti - extends
        $this->connection = $this->getConnection(); // ukladám pripojenie k databáze
    }

    public function getPackages(): array
    {
        $sql = "SELECT packages.id, title, description, img, duration, person, price, city, country FROM packages INNER JOIN destination ON packages.idcity = destination.id";
        $stmt = $this->connection->prepare($sql); //pripravím dodtaz
        $stmt->execute(); //vykonám dotaz
        $packages = $stmt->fetchAll(\PDO::FETCH_ASSOC); //výsledky načítam do asoc pola kluc-hodnota, all pole všetkých riadkov
        return $packages;
    }
    public function insertTour(array $data): bool
    {
        $packageInsertSQL = "INSERT INTO packages (`title`, `description`, `img`, `duration`, `person`, `price`, `idcity`) 
                  VALUES (:title, :description, :img, :duration, :person, :price, :idcity)";
        $packageInsertStmt = $this->connection->prepare($packageInsertSQL);
        // Hodnoty pre Tour package
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $img = $data['img'] ?? '';
        $duration = $data['duration'] ?? '';
        $person = $data['person'] ?? '';
        $price = $data['price'] ?? '';
        $idcity = $data['idcity'] ?? '';



        // Vloženie hlavnej položky tour
        $insert = $packageInsertStmt->execute([
            ':title' => $title, //paramerer ktorý bude nahradený hodnotou pri vykonaní dotazu
            ':description' =>  $description,
            ':img' => $img,
            ':duration' => $duration,
            ':person' =>  $person,
            ':price' =>$price,
            ':idcity' => $idcity,

        ]);

        return $insert;
    }

    public function deleteTour(int $id): bool{
        $tourDeleteSQL = "DELETE FROM packages WHERE id = :id";
        $tourDeleteStmt = $this->connection->prepare($tourDeleteSQL);

        // Vloženie hlavnej položky tour
        $delete = $tourDeleteStmt->execute([
            ':id' => $id
        ]);

        return $delete;
    }

    public function updateTour(int $id, array $data): bool{

        $tourUpdatetSQL = "UPDATE packages 
                          SET `title` = :title, 
                              `description` = :description, 
                              `img` = :img, 
                              `duration` = :duration, 
                              `person` = :person, 
                              `price` = :price, 
                              `idcity` = :idcity 
                              WHERE id = :id";

        $tourUpdateStmt = $this->connection->prepare($tourUpdatetSQL);
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $img = $data['img'] ?? '';
        $duration = $data['duration'] ?? '';
        $person = $data['person'] ?? '';
        $price = $data['price'] ?? '';
        $idcity = $data['idcity'] ?? '';

        $update =$tourUpdateStmt->execute([
            ':title' => $title,
            ':description' =>  $description,
            ':img' => $img,
            ':duration' => $duration,
            ':person' =>  $person,
            ':price' =>$price,
            ':idcity' => $idcity,
            ':id' => $id
        ]);
        return $update;

    }

    public function getPackagesId(int $id): array
    { $sql = "SELECT packages.id, title, description, img, duration, person, price, idcity, city, country FROM packages INNER JOIN destination ON packages.idcity = destination.id WHERE packages.id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $packages = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $packages;
    }

}
