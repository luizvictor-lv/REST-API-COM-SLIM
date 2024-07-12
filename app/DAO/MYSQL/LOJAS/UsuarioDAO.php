<?php
declare(strict_types=1);
namespace App\DAO\MYSQL\Lojas;

require __DIR__ . "/../../../../vendor/autoload.php";
use App\Models\UsuarioModel;
use PDO;
use PDOException;

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
    try {
        // Verifica se o email já está cadastrado
        $check_email_query = 'SELECT * FROM usuarios WHERE email = :email';
        $check_email_stmt = $this->pdo->prepare($check_email_query);
        $check_email_stmt->execute(['email' => $usuario->getEmail()]);

        if ($check_email_stmt->rowCount() > 0) {
            return ['message' => 'Este Usuário já está cadastrado.'];
        }

        // Insere o novo usuário
        $insert_query = 'INSERT INTO usuarios (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)';
        $insert_stmt = $this->pdo->prepare($insert_query);
        $insert_stmt->execute([
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'telefone' => $usuario->getTelefone(),
            'senha' => password_hash($usuario->getSenha(), PASSWORD_DEFAULT)
        ]);

        return ['message' => 'Usuário cadastrado com sucesso.'];

    } catch (PDOException $e) {
        return ['error' => $e->getMessage()];
    }
}


    public function getUsuario()
    {    
        $nome = isset($_GET['nome']) ? $_GET['nome'] : '';
        $stmt = $this->pdo->prepare("SELECT id, nome, email, telefone FROM usuarios WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioId($id)
    {
        $id = isset($_GET['id']) ? $_GET['id'] :'';
        $stmt = $this->pdo->prepare('SELECT id, nome, email, telefone FROM usuarios WHERE id = :id');
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
