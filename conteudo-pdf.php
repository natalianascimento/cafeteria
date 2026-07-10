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
    <style>
        .relatorio-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-family: sans-serif;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            table-layout: fixed;
        }

        /* Definindo larguras específicas */
        .relatorio-table th:nth-child(1) { width: 15%; }
        .relatorio-table th:nth-child(2) { width: 10%; }
        .relatorio-table th:nth-child(3) { width: 60%; }
        .relatorio-table th:nth-child(4) { width: 15%; }

        .relatorio-table thead tr {
            background-color: #2D3E35;
            color: #E6D2B5;
            text-align: left;
        }

        /* Alinha o título "Valor" à direita também */
        .relatorio-table th:nth-child(4) { text-align: right; }

        .relatorio-table th, .relatorio-table td {
            padding: 12px 15px;
        }

        .relatorio-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .relatorio-table td {
            word-wrap: break-word;
            vertical-align: top;
        }

        .relatorio-table td:nth-child(4) {
            white-space: nowrap; 
            text-align: right;
        }

        /* Garante que o fundo apareça no PDF */
        @media print {
            .relatorio-table {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
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