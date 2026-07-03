<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function formarObjeto($dados)
    {
        return new Produto(
                $dados['id'], 
                $dados['tipo'],
                $dados['nome'], 
                $dados['descricao'], 
                $dados['preco'], 
                $dados['imagem']
                );
    }

    public function opcoesCafe(): array
    {
        $queryCafe = "SELECT * FROM produtos WHERE tipo = 'cafe' ORDER BY preco";
        $statement = $this->pdo->query($queryCafe);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe) {
            return $this->formarObjeto($cafe);
        }, $produtosCafe);

        return $dadosCafe;
    }

    public function opcoesAlmoco(): array
    {
        $queryAlmoco = "SELECT * FROM produtos WHERE tipo = 'almoço' ORDER BY preco";
        $statement = $this->pdo->query($queryAlmoco);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAlmoco = array_map(function ($almoco) {
           return $this->formarObjeto($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }

    public function buscarProdutos(): array {
        $query = "SELECT * FROM produtos ORDER BY tipo, nome";
        $statement = $this->pdo->query($query);
        $todosProdutos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $produtos = array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $todosProdutos);

        return $produtos;
    }
}