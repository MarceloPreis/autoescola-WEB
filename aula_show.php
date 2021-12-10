<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$title = "Lista de Clientes";
$id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href='css/estilo.css' rel='stylesheet' />
    <title> <?php echo $title; ?> </title>
</head>

<body>

    <div class="header">
        <h1>Aulas</h1>
    </div>

    <div class="topnav">
        <a href="agenda.php">Agenda</a>
        <a href="aula_cadastro.php">Novo</a>
        <a href="aula_cadastro.php?acao=editar&id=<?php echo $id; ?>">Alterar</a>
        <a href="aula_acao.php?acao=excluir&id=<?php echo $id; ?>">Excluir</a>
    </div>

    </br>
    <div class="show">
        <h2> Dados da Aula</h2>
        <?php

        $sql = "SELECT * FROM autoescola.aula WHERE idaula = $id";

        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<strong>Código: </strong>{$linha['idaula']} </br>";
            $idAluno = $linha['idAluno'];
            $idInstrutor = $linha['idInstrutor'];
            $idVeiculo = $linha['idVeiculo'];
            $inicio = $linha['horarioIncio'];
            $fim = $linha['horarioFIm'];
        }


        $sql = "SELECT nome FROM autoescola.aluno WHERE id = $idAluno";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<strong>Aluno: </strong>{$linha['nome']} </br>";
        }

        $sql = "SELECT nome FROM autoescola.instrutor WHERE id = $idInstrutor";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<strong>Instrutor: </strong>{$linha['nome']} </br>";
        }

        $sql = "SELECT placa FROM autoescola.veiculo WHERE id = $idVeiculo";
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<strong>Veículo (placa): </strong>{$linha['placa']} </br>";
        }

        echo "<strong>Início: </strong>$inicio </br>";
        echo "<strong>Fim: </strong>$fim </br>";

        ?>

        
    </div>
</body>

</html>