<?php

  require_once 'src/conexao-db.php';
  require_once 'src/Modelo/Produto.php';
  require_once 'src/Repositorio/ProdutoRepositorio.php';

  $produtoRepositorio = new ProdutoRepositorio($pdo);
  $produtoRepositorio->excluirProduto($_GET['id']);

  