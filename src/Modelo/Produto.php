<?php

class produto
{
    private ?int $id;
    private string $tipo;
    private string $nome;
    private string $descricao;
    private float $preco;
    private string $imagem;

    public function __construct(?int $id, string $tipo, string $nome, string $descricao, float $preco, string $imagem = "logo-serenatto.png")
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->preco = $preco;
        $this->imagem = $imagem;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function setNome($nome)
    {
        if (strlen($nome) < 3 || strlen($nome) > 45){
            throw new Exception("Campo 'Nome' deve ter entre 3 e 45 caracteres.");
        }
        $this->nome = $nome;
    }

    public function setDescricao($descricao)
    {
        if (strlen($descricao) < 10 || strlen($descricao) > 90){
            throw new Exception("Campo 'Descrição' deve ter entre 10 e 90 caracteres.");
        }
        $this->descricao = $descricao;
    }

    public function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }

    public function getPrecoFormatado(): string
    {
        return "R$ " . number_format($this->preco, 2, ',', '.');
    }

    public function getImagemDiretorio(): string
    {
        return "img/" . $this->imagem;
    }
    
}