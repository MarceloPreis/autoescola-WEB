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
        
        $descricao = "";
        $cpf = "";
        $salario = "";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO autoescola.instrutor (nome,cpf,salario) VALUES(:nome,:cpf,:salario)');
        $stmt->bindParam(':nome', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':salario', $salario, PDO::PARAM_STR);

        $descricao = $dados['nome'];
        $cpf = $dados['cpf'];
        $salario = $dados['salario'];
        $stmt->execute();
        header("location:instrutor_index.php");
        
    }

    function editar($id){

        $nome = "";
        $cpf = "";
        $salario = "";

        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE autoescola.instrutor SET nome = :nome, cpf = :cpf, salario = :salario  WHERE id = :id');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_INT);
        $stmt->bindParam(':salario', $salario, PDO::PARAM_INT);

        $nome = $dados['nome'];
        $cpf = $dados['cpf'];
        $salario = $dados['salario'];

        $stmt->execute();

        header("location:instrutor_index.php");
    }

    function excluir($id){

        $idD = "";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from autoescola.instrutor WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:instrutor_index.php");
        

    }


    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM autoescola.instrutor WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['nome'] = $linha['nome'];
            $dados['cpf'] = $linha['cpf'];
            $dados['salario'] = $linha['salario'];
        }
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['cpf'] = $_POST['cpf'];
        $dados['salario'] = $_POST['salario'];

        return $dados;
    }

?>