<?php
declare(strict_types=1);
require __DIR__  . "/../vendor/autoload.php";


use App\Controllers\ProdutosController;
use App\Controllers\UsuarioController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;


$app = AppFactory::create();

$app->setBasePath('/loja/public');

$app->addBodyParsingMiddleware();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->post('', [UsuarioController::class,'cadastroUsuario']);
    $group->get('', [UsuarioController::class,'getUsuario']);
    $group->get('/{id}', [UsuarioController::class,'getUsuarioId']);
    $group->put('/{id}', [UsuarioController::class,'atualizarUsuario']);
    $group->delete('/{id}', [UsuarioController::class,'deletarUsuario']);
});

// $app->group('/produtos', function (RouteCollectorProxy $group) {
//     $group->post('', [ProdutosController::class,'cadastroProdutos']);
//     $group->get('', [ProdutosController::class,'listarProdutos']);
//     $group->get('/{id}', [ProdutosController::class, 'buscarProdutosPorId']);
//     $group->put('/{id}', [ProdutosController::class,'atualizarProdutos']);
//     $group->delete('/{id}', [ProdutosController::class,'deletarProdutos']);
// });

$app->run();
