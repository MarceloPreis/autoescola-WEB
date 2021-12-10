<!DOCTYPE html>
<?php
include_once "instrutor_acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">

    <title>Instrutores</title>
</head>

<body>

    <div class = "header">
        <h1>Instrutores</h1>
    </div>

    <div class = "topnav">
        <a href="home.php">Home</a>
        <a href="instrutor_index.php">Listar</a>
        <a href="instrutor_cadastro.php">Novo</a>
    </div>
    
    <form action="instrutor_acao.php" method="post" class="formulario">

        ID
        <input readonly type="text" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id'];
                                                                else echo 0; ?>"><br>

        Nome
        <input required=true type="text" name="nome" id="nome" value="<?php if ($acao == "editar") echo $dados['nome']; ?>"><br>
        CPF
        <input required=true type="text" name="cpf" id="cpf" value="<?php if ($acao == "editar") echo $dados['cpf']; ?>"><br>
        Salário
        <input required=true type="number" name="salario" id="salario" value="<?php if ($acao == "editar") echo $dados['salario']; ?>"><br>



        <br><button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
    </form>
</body>

</html>