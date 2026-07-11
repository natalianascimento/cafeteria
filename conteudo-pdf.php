<?php

  require_once 'src/conexao-db.php';
  require_once 'src/Modelo/Produto.php';
  require_once 'src/Repositorio/ProdutoRepositorio.php';
  
  $produtoRepositorio = new ProdutoRepositorio($pdo);
  $produtos = $produtoRepositorio->buscarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório Serenatto</title>
    <link rel="stylesheet" href="css/conteudo-pdf.css">
</head>
<body>
    <table class="relatorio-table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto) { ?>
            <tr>
                <td><?= $produto->getNome() ?></td>
                <td><?= $produto->getTipo() ?></td>
                <td><?= $produto->getDescricao() ?></td>
                <td><?= $produto->getPrecoFormatado() ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>