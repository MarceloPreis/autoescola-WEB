<!DOCTYPE html>

<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
?>
<html lang="pt-BR">

<?php
include_once "aula_acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/estilo.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cadastro de Aulas</title>
</head>

<body>
    </br></br>

    <div class="header">
        <h1> Cadastro de aulas </h1>
    </div>

    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="agenda.php">Agenda</a></br></br></br>
    </div>
    <div>
        <form method="post" action="aula_acao.php" class="formulario">
            ID

            <input readonly type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id']; else echo 0; ?>"><br>

            Instrutor

            <select name="idInstrutor" id="idInstrutor">
                <?php

                $sql = "SELECT id, nome FROM autoescola.instrutor";
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query($sql);
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $linha['id']; ?>" <?php if ($acao == "editar"){if($linha['id'] == $dados['idVeiculo']){echo "selected";}}?>> <?php echo $linha['nome']?> </option>
                <?php } ?>

            </select></br></br>

            Aluno
            <select name="idAluno" id="idAluno">
                <?php
                $sql = "SELECT id, nome FROM autoescola.aluno";
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query($sql);
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $linha['id']; ?>"  <?php if ($acao == "editar"){if($linha['id'] == $dados['idAluno']){echo "selected";}}?>> <?php echo $linha['nome']; ?> </option>
                <?php } ?>

            </select></br></br>


            Veículo
            <select name="idVeiculo" id="idVeiculo">
                <?php
                $sql = "SELECT id, placa FROM autoescola.veiculo";
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query($sql);
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $linha['id']; ?>"  <?php if ($acao == "editar"){if($linha['id'] == $dados['idVeiculo']){echo "selected";}}?>> <?php echo $linha['placa']; ?> </option>
                <?php } ?>

            </select></br></br>
    </div>

    <div class="listagem">

        <table class="table table-borderless">

            <tr>
                <th> Carga horária </th>
                <th> Início </th>
                <th> Fim </th>
            </tr>

            <tr>

                <td><input type="number" name="cargaHoraria" id="cargaHoraria" value="<?php if($acao == 'editar') echo $dados['cargaHoraria']  ?>"> </td>
                <td><input type="datetime-local" name="horarioIncio" id="horarioIncio" value="<?php $dateHtml = date("Y-m-d\TH:i:s", strtotime($dados['horarioIncio'])); if($acao == 'editar') echo "$dateHtml"  ?>"></td>
                <td><input type="datetime-local" name="horarioFIm" id="horarioFIm" value="<?php $dateHtml = date("Y-m-d\TH:i:s", strtotime($dados['horarioFIm'])); if($acao == 'editar') echo "$dateHtml"  ?>"></td>
            </tr>
        </table>

        <button name="acao" value="salvar" id="acao" type="submit">
            Salvar
        </button></br></br>
        </form>
        
    </div>

</body>

</html>