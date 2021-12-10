<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$title = "Lista de Veículos";
$consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";

?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href='css/estilo.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</head>

<body>
    </br></br>  
    <div class="header">
        <h1> Veículos </h1>
    </div>

    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="veiculo_cadastro.php">Novo</a>
    </div>

    <br><br>
    <form method="post" class = "formulario">
            Pesquisa
        <input type="text" name="consulta" id="consulta" value="<?php echo $consulta; ?>">
        <input type="submit" value="Pesquisar">
    </form>
    
    <div class = "listagem">
    <br>
    <table class="table table-striped">
        <tr>
            <th>Código</th>
            <th>Modelo</th>
            <th>Placa</th>
            <th>Detalhes</th>
            <th>Alterar</th>
            <th>Excluir</th>

        </tr>
        <?php
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM autoescola.veiculo 
                             WHERE placa 
                             LIKE '$consulta%'");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td><?php echo $linha['id']; ?></td>
                <td><?php echo $linha['modelo']; ?></td>
                <td><?php echo $linha['placa']; ?></td>
                <td><a href='veiculo_show.php?id=<?php echo $linha['id']; ?>'> <img class="icon" src="img/show.png" alt=""> </a></td>
                <td><a href='veiculo_cadastro.php?acao=editar&id=<?php echo $linha['id']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
                <td><a href="javascript:excluirRegistro('veiculo_acao.php?acao=excluir&id=<?php echo $linha['id']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
            </tr>
        <?php } ?>
    </table>
    </div>        
</body>

</html>