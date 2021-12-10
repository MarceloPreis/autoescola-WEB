<!DOCTYPE html>
<?php
include_once "veiculo_acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
//var_dump($dados);
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='css/estilo.css' rel='stylesheet' />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Veículos</title>
</head>

<body>

    <div class="header">
        <h1>Cadastro de Veículos</h1>
    </div>

    <div class="topnav">
        <a href="veiculo_index.php">Listar</a>
        <a href="veiculo_cadastro.php">Novo</a>
    </div>
    <br><br>
    <form action="veiculo_acao.php" method="post" class="formulario">
        ID
        <input readonly type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id'];
                                                                else echo 0; ?>"><br>

        Modelo
        <input required=true type="text" name="modelo" id="modelo" value="<?php if ($acao == "editar") echo $dados['modelo']; ?>"><br>

        Placa
        <input required=true type="text" name="placa" id="placa" value="<?php if ($acao == "editar") echo $dados['placa']; ?>"><br>
        <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
    </form>
</body>

</html>