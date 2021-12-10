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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> <?php echo $title; ?> </title>
</head>

<body>
    </br></br>
    <div class="header">
        <h1> Veículos </h1>
    </div>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="veiculo_index.php">Listar</a>
        <a href="veiculo_cadastro.php">Novo</a>
        <a href="veiculo_cadastro.php?acao=editar&id=<?php echo $id; ?>">Alterar</a>

    </div>
    </br>

    <div class="show">
        <h2> Dados do Veículo </h2>

        <?php

        $sql = "SELECT * FROM autoescola.veiculo WHERE id = $id";

        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
            echo "<strong>Código: </strong>{$linha['id']} </br> <strong>Modelo:</strong> {$linha['modelo']} </br> <strong>Placa:</strong> {$linha['placa']}</br>";
        }
        ?>
        </br>
    </div>

    <div class="listagem">
        <table class="table table-striped">
            <thead>

                <tr>
                    <th>Aluno</th>
                    <th>Instrutor</th>
                    <th>Veículo</th>
                    <th>Início</th>
                    <th>Fim</th>
                </tr>
            </thead>



            <?php
            echo "<h2> Aulas Vinculadas </h2>";
            $sql = "SELECT * FROM autoescola.aula WHERE idVeiculo = $id";

            $pdo = Conexao::getInstance();
            $consulta = $pdo->query($sql);
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                $idAula = $linha['idaula'];
                $idAluno = $linha['idAluno'];
                $idInstrutor = $linha['idInstrutor'];
                $idVeiculo = $linha['idVeiculo'];
                $inicio = $linha['horarioIncio'];
                $fim = $linha['horarioFIm'];
            }
            ?>
            <tbody>
                <tr>
                    <?php
                    $sql = "SELECT nome FROM autoescola.aluno WHERE id = $idAluno";
                    $consulta = $pdo->query($sql);
                    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                    ?>
                        <td><?php echo $linha['nome'] ?></td>
                    <?php
                    }

                    $sql = "SELECT nome FROM autoescola.instrutor WHERE id = $idInstrutor";
                    $consulta = $pdo->query($sql);
                    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                    ?>
                        <td><?php echo $linha['nome'] ?>
                        </td><?php
                            }

                            $sql = "SELECT placa FROM autoescola.veiculo WHERE id = $idVeiculo";
                            $consulta = $pdo->query($sql);
                            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                                ?>
                        <td>
                            <?php echo $linha['placa'] ?>
                        </td><?php
                            }

                                ?>
                    <td><?php echo $inicio ?>
                    </td><?php
                            ?>
                    <td><?php echo $fim ?>
                    </td><?php

                            ?>
                </tr>
            </tbody>
    </div>

</body>

</html>