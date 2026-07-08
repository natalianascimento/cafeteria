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

    public function buscarProdutos(): array 
    {
        $query = "SELECT * FROM produtos ORDER BY tipo, nome";
        $statement = $this->pdo->query($query);
        $todosProdutos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $produtos = array_map(function ($produto) {
            return $this->formarObjeto($produto);
        }, $todosProdutos);

        return $produtos;
    }

    public function excluirProduto(int $id)
    {
        $query = "DELETE FROM produtos WHERE id = ?";
        $statement =$this->pdo->prepare($query);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    public function salvar(Produto $produto) 
    {
        $query = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->execute();
    }

    public function buscarProdutoPorId(int $id)
    {
        $query = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $id);
        $statement->execute();
        $produto = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($produto);
    }

    public function atualizarProduto(Produto $produto)
    {
        $query = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ? WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getId());
        $statement->execute();

        if ($produto->getImagem() != 'logo-serenatto.png'){
            $this->atualizarImagem($produto);
        }
    }

    private function atualizarImagem(Produto $produto)
    {
        $sql = "UPDATE produtos SET imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getImagem());
        $statement->bindValue(2, $produto->getId());
        $statement->execute();
    }
}