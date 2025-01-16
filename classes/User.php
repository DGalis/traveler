<?php

namespace classes;
include_once("classes/Dbconnection.php");

class User extends Dbconnection
{
    private $role;
    protected $connection;

    public function __construct() {
        parent::__construct();
        $this->connection = $this->getConnection();
    }

    public function login($email, $password)
    {
        try {
            // Skontroluje či používateľ existuje
            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $this->connection->prepare($sql);
            $statement->execute(['email' => $email]);
            $user = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                throw new \Exception("User not found.");
            }

            // Overi heslo
            if ($password !== $user['password']) {
                throw new \Exception("Invalid password.");
            }

            // Spusti reláciu a uložiť informácie o používateľovi
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['rola'] = $user['rola'];

            // Presmeruje na novú stránku
            header('Location: adminhome.php');
            exit;
        } catch (\PDOException $e) {
            echo "Database error: " . $e->getMessage();
        } catch (\Exception $e) {
            echo "Login error: " . $e->getMessage();
        }
    }
    public function isAdmin(){
        if (isset($_SESSION['rola']) && $_SESSION['rola'] === 'admin') {
            return true;
        }
        return false;
    }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("location: login.php");
        exit;
    }
}
