<?php
declare(strict_types=1);
namespace App\DAO\MYSQL\Lojas;

require __DIR__ . "/../../../../vendor/autoload.php";
use App\Models\UsuarioModel;
use PDO;

class UsuarioDAO extends Conexao
{
    protected $pdo;

    public function __construct()
    {
        // Chama o construtor da classe pai
        parent::__construct();
    }
    public function cadastroUsuario(UsuarioModel $usuario)
    {
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)');
        $stmt->execute([
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'telefone' => $usuario->getTelefone(),
            'senha' => password_hash($usuario->getSenha(), PASSWORD_DEFAULT)
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuario()
    {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioId($id)
    {
        $stmt = $this->pdo->prepare('SELECT id, nome, email, telefone, senha FROM usuarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarUsuario(UsuarioModel $usuario)
    {
        $stmt = $this->pdo->prepare('UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, senha = :senha WHERE id = :id');
        $stmt->execute([
            'id' => $usuario->getId(),
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'telefone' => $usuario->getTelefone(),
            'senha' => password_hash($usuario->getSenha(), PASSWORD_DEFAULT)
        ]);
    }

    public function deletarUsuario($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM usuarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
