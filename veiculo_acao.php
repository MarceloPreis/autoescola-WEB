<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        if ($id == 0)
            inserir($id);
        else
            editar($id);
    }

    // Métodos para cada operação
    function inserir($id){
        $dados = dadosForm();
        //var_dump($dados);
        
        $modelo = "";
        $placa = "";
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO autoescola.veiculo (modelo,placa) VALUES(:modelo,:placa)');
        $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
        $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);

        $modelo = $dados['modelo'];
        $placa = $dados['placa'];
        $stmt->execute();
        header("location:veiculo_index.php");
        
    }

    function editar($id){

        $modelo = "";
        $placa = "";

        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE autoescola.veiculo SET modelo = :modelo, placa = :placa WHERE id = :id');

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);
        $stmt->bindParam(':placa', $placa, PDO::PARAM_INT);

        $id = $dados['id'];
        $modelo = $dados['modelo'];
        $placa = $dados['placa'];
        $stmt->execute();
        header("location:veiculo_index.php");
    }

    function excluir($id){

        $idD = "";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from autoescola.veiculo WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:veiculo_index.php");
        

    }


    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM autoescola.veiculo WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['modelo'] = $linha['modelo'];
            $dados['placa'] = $linha['placa'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['modelo'] = $_POST['modelo'];
        $dados['placa'] = $_POST['placa'];

        return $dados;
    }

?>