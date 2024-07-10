<?php 
declare(strict_types=1);

namespace App\DAO\MYSQL\Lojas;

use PDO;
use PDOException;

require_once __DIR__ . "/../../../../vendor/autoload.php";
// require_once __DIR__ . "/../../../../env.php";

abstract class Conexao 
{
    protected $pdo;

    public function __construct()
    {
        $host = "www.victor.com.br";
        $dbname = "cadastro";
        $username = "user";
        $password = "rootpassword";
        $port = 3306;
        $charset = "utf8mb4";

       $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

        try {
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);

            echo "Conexão bem-sucedida!<br>";
        } catch (PDOException $e) {
            // Opcional: Você pode lançar uma exceção ou logar o erro
            throw new \Exception('Erro ao conectar com o banco de dados: ' . $e->getMessage());
        }
        
    }
}
