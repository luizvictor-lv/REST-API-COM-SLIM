<?php

namespace App\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

class ProdutosModel
{
    private $id;
    private $lojaid;
    private $preco;
    private $quantidade;

    /**
 * Retorna o ID do cliente.
 *
 * Esta função é usada para obter o ID do cliente. O ID é um valor
 * inteiro que identifica de forma única um cliente no banco de dados.
 *
 * @return int O ID do cliente.
 */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getLojaId(): string
    {
        return $this->lojaid;
    }

    public function setLojaId(string $lojaid): void
    {
        $this->lojaid = $lojaid;
    }

    public function getPreco(): string
    {
        return $this->preco;
    }

    public function setPreco(string $preco): void
    {
        $this->preco = $preco;
    }

    public function getQuantidade(): string
    {
        return $this->quantidade;
    }

public function setQuantidade(string $quantidade): void
    {
        $this->quantidade = $quantidade;
    }
}
