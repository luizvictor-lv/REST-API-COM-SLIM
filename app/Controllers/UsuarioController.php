<?php
declare(strict_types=1);
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\UsuarioModel;
use App\DAO\MYSQL\Lojas\UsuarioDAO;

require_once __DIR__ . "/../../vendor/autoload.php";

class UsuarioController
{
    public function cadastroUsuario(Request $request, Response $response, array $args): Response{
    {
        $data = $request->getParsedBody();
        
        // Verifica se os dados esperados estão presentes
        if (!isset($data['nome'], $data['email'], $data['telefone'], $data['senha'])) {
            $response->getBody()->write(json_encode(['message' => 'Dados incompletos']));
            return $response->withStatus(400);
        } else 
        
        $usuario = new UsuarioModel();
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);
        $usuario->setTelefone($data['telefone']);
        $usuario->setSenha($data['senha']);

        $dao = new UsuarioDAO();
        $dao->cadastroUsuario($usuario);

        $response->getBody()->write(json_encode(['message' => "Usuário cadastrado com sucesso: Nome - {$data['nome']}, Email - {$data['email']}"]));
        return $response->withHeader('Content-Type', 'application/json');}
    }

    public function getUsuario(Request $request, Response $response, array $args): Response
    {   

        $dao = new UsuarioDAO();
        $usuarios = $dao->getUsuario();
        
        $response->getBody()->write(json_encode($usuarios));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getUsuarioId(Request $request, Response $response, array $args): Response
    {
        $usuarioId = $args['id'];
        $dao = new UsuarioDAO();
        $usuario = $dao->getUsuarioId($usuarioId);
        
        if (!$usuario) {
            $response->getBody()->write(json_encode(['message' => 'Usuário não encontrado']));
            return $response->withStatus(404);
        }
        
        $response->getBody()->write(json_encode($usuario));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function atualizarUsuario(Request $request, Response $response, array $args): Response
    {
        $usuarioId = $args['id'];
        $data = $request->getParsedBody();

        // Verifica se os dados esperados estão presentes
        if (!isset($data['nome'], $data['email'], $data['telefone'], $data['senha'])) {
            $response->getBody()->write(json_encode(['message' => 'Dados incompletos']));
            return $response->withStatus(400);
        }

        $usuario = new UsuarioModel();
        $usuario->setId($usuarioId);
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);
        $usuario->setTelefone($data['telefone']);
        $usuario->setSenha($data['senha']);

        $dao = new UsuarioDAO();
        $dao->atualizarUsuario($usuario);

        $response->getBody()->write(json_encode(['message' => "Usuário com ID $usuarioId atualizado com sucesso"]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deletarUsuario(Request $request, Response $response, array $args): Response
    {
        $usuarioId = $args['id'];
        $dao = new UsuarioDAO();
        $dao->deletarUsuario($usuarioId);
        
        $response->getBody()->write(json_encode(['message' => "Usuário com ID $usuarioId deletado com sucesso"]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
