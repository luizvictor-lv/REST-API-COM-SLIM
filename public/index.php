<?php
declare(strict_types=1);
require __DIR__  . "/../vendor/autoload.php";

use App\Controllers\UsuarioController;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;


$app = AppFactory::create();

    $app->setBasePath('/loja/public');

    $app->addBodyParsingMiddleware();

    $app->addRoutingMiddleware();

    $errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->group('/usuarios', function (RouteCollectorProxy $group) 
{
    $group->post('', [UsuarioController::class,'cadastroUsuario']);
    $group->get('/', [UsuarioController::class,'getUsuario']);
    $group->get('/{id}', [UsuarioController::class,'getUsuarioId']);
    $group->put('/{id}', [UsuarioController::class,'atualizarUsuario']);
    $group->delete('/{id}', [UsuarioController::class,'deletarUsuario']);
});

$app->run();
