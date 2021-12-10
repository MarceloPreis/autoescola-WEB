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
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> Alunos </title>
</head>

<body>
    </br></br>
    <div class="header">
        <h1>Alunos</h1>
    </div>
    <div class="topnav">
        <a href="aluno_index.php">Listar</a>
        <a href="aluno_cadastro.php">Novo</a>
        <a href="aluno_cadastro.php?acao=editar&id=<?php echo $id; ?>">Alterar</a>
    </div>

    <div class="show">
        <?php
        echo "<h2> Dados do Aluno </h2>";
        $sql = "SELECT * FROM autoescola.aluno WHERE id = $id";

        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<strong>Id: </strong>{$linha['id']} </br> 
            <strong>Nome: </strong> {$linha['id']} </br> 
            <strong>CPF: </strong>{$linha['cpf']} </br> ";
        }

        $sql = "SELECT * FROM autoescola.endereço WHERE id_aluno = $id";
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<strong>Endereço: </strong>{$linha['rua']}, {$linha['bairro']}, {$linha['cidade']}  ";
        }


        ?>

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


            echo "<h2> Aulas </h2>";
            $sql = "SELECT * FROM autoescola.aula WHERE idAluno = $id";

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

            if ($idAluno != null) {
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
                    <td><?php echo $linha['nome'] ?></td>
                <?php
                }

                $sql = "SELECT placa FROM autoescola.veiculo WHERE id = $idVeiculo";
                $consulta = $pdo->query($sql);
                while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                ?>
                    <td><?php echo $linha['placa'] ?></td>
                <?php
                }

                ?>
                <td><?php echo $inicio ?>
                </td><?php
                        ?>
                <td><?php echo $fim ?>
                </td>
            <?php } ?>

        </table>

    </div>
</body>

</html>