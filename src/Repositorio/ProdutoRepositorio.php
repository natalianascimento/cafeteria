<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function opcoesCafe(): array
    {
        $queryCafe = "SELECT * FROM produtos WHERE tipo = 'cafe' ORDER BY preco";
        $statement = $this->pdo->query($queryCafe);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe) {
            return new Produto(
                $cafe['id'], 
                $cafe['tipo'],
                $cafe['nome'], 
                $cafe['descricao'], 
                $cafe['preco'], 
                $cafe['imagem']
                );
        }, $produtosCafe);

        return $dadosCafe;
    }

    public function opcoesAlmoco(): array
    {
        $queryAlmoco = "SELECT * FROM produtos WHERE tipo = 'almoço' ORDER BY preco";
        $statement = $this->pdo->query($queryAlmoco);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);


        $dadosAlmoco = array_map(function ($almoco) {
            return new Produto(
                $almoco['id'], 
                $almoco['tipo'],
                $almoco['nome'], 
                $almoco['descricao'], 
                $almoco['preco'], 
                $almoco['imagem']
                );
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }
}