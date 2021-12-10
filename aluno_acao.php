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
        
        $nome = "";
        $cpf = "";
        $rua = "";
        $cidade = "";
        $bairro = "";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO autoescola.aluno (nome,cpf) VALUES(:nome,:cpf)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);

        $nome = $dados['nome'];
        $cpf = $dados['cpf'];
        $stmt->execute();

        $lid = $pdo -> lastInsertId();

        $stmt = $pdo->prepare('INSERT INTO autoescola.endereço VALUES(:id_aluno, :rua, :bairro, :cidade)');
        $stmt->bindParam(':id_aluno', $lid, PDO::PARAM_STR);
        $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);

        $rua = $dados['rua'];
        $cidade = $dados['cidade'];
        $bairro = $dados['bairro'];
        
        $stmt->execute();


        header("location:aluno_index.php");
        
    }

    function editar($id){

        $nome = "";
        $cpf = "";
        $rua = "";
        $cidade = "";
        $bairro = "";

        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare("UPDATE autoescola.aluno SET nome = :nome, cpf = :cpf WHERE id = $id");
        
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_INT);

        $nome = $dados['nome'];
        $cpf = $dados['cpf'];
        $stmt->execute();

        $stmt = $pdo->prepare("UPDATE autoescola.endereço SET rua = :rua, bairro = :bairro, cidade = :cidade WHERE id_aluno = $id");

        $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);


        $rua = $dados['rua'];
        $cidade = $dados['cidade'];
        $bairro = $dados['bairro'];
        
        $stmt->execute();

        header("location:aluno_index.php");
    }

    function excluir($id){

        $idD = "";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE FROM autoescola.aluno WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();

        header("location:aluno_index.php");
        

    }


    // Busca um item pelo código no BD
    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM autoescola.aluno WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id'] = $linha['id'];
            $dados['nome'] = $linha['nome'];
            $dados['cpf'] = $linha['cpf'];

        }
        $consulta = $pdo->query("SELECT * FROM autoescola.endereço WHERE id_aluno = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['rua'] = $linha['rua'];
            $dados['bairro'] = $linha['bairro'];
            $dados['cidade'] = $linha['cidade'];

        }

        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['cpf'] = $_POST['cpf'];
        $dados['rua'] = $_POST['rua'];
        $dados['bairro'] = $_POST['bairro'];
        $dados['cidade'] = $_POST['cidade'];

        return $dados;
    }

?>