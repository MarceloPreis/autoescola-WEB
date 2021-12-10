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

function inserir($id) {

    $dados = dadosForm();


    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO autoescola.aula (idInstrutor, idAluno, idVeiculo, cargaHoraria, horarioIncio, horarioFIm) 
                               VALUES(:idInstrutor, :idAluno, :idVeiculo, :cargaHoraria, :horarioIncio, :horarioFIm)');

    $idInstrutor = $_POST['idInstrutor'];
    $idAluno = $_POST['idAluno'];
    $idVeiculo = $_POST['idVeiculo'];
    $cargaHoraria = $_POST['cargaHoraria'];
    $horarioIncio = $_POST['horarioIncio'];
    $horarioFIm = $_POST['horarioFIm'];

    $stmt->bindParam(':idInstrutor', $idInstrutor, PDO::PARAM_STR);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_STR);
    $stmt->bindParam(':idVeiculo', $idVeiculo, PDO::PARAM_STR);
    $stmt->bindParam(':cargaHoraria', $cargaHoraria, PDO::PARAM_STR);
    $stmt->bindParam(':horarioIncio', $horarioIncio, PDO::PARAM_STR);
    $stmt->bindParam(':horarioFIm', $horarioFIm, PDO::PARAM_STR);

    $stmt->execute();

    header("location:agenda.php");
}

function editar($id){

    $dados = dadosForm();
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare("UPDATE autoescola.aula SET idInstrutor = :idInstrutor, 
                            idAluno = :idAluno, 
                            idVeiculo = :idVeiculo, 
                            cargaHoraria = :cargaHoraria,
                            horarioIncio = :horarioIncio, 
                            horarioFIm = :horarioFIm 
                            WHERE idaula = $id");

    $idInstrutor = $dados['idInstrutor'];
    $idAluno = $dados['idAluno'];
    $idVeiculo = $dados['idVeiculo'];
    $cargaHoraria = $dados['cargaHoraria'];
    $horarioIncio = $dados['horarioIncio'];
    $horarioFIm = $dados['horarioFIm'];

    $stmt->bindParam(':idInstrutor', $idInstrutor, PDO::PARAM_STR);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_STR);
    $stmt->bindParam(':idVeiculo', $idVeiculo, PDO::PARAM_STR);
    $stmt->bindParam(':cargaHoraria', $cargaHoraria, PDO::PARAM_STR);
    $stmt->bindParam(':horarioIncio', $horarioIncio, PDO::PARAM_STR);
    $stmt->bindParam(':horarioFIm', $horarioFIm, PDO::PARAM_STR);

    $stmt->execute();
    header("location:agenda.php");
}

function excluir($id){

    $idD = "";

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('DELETE FROM autoescola.aula WHERE idaula = :id');
    $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
    $idD = $id;
    $stmt->execute();

    header("location:agenda.php");
    

}

 // Busca um item pelo código no BD
 function buscarDados($id){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM autoescola.aula WHERE idaula = $id");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['id'] = $linha['idaula'];
        $dados['idInstrutor'] = $linha['idInstrutor'];
        $dados['idAluno'] = $linha['idAluno'];
        $dados['idVeiculo'] = $linha['idVeiculo'];
        $dados['cargaHoraria'] = $linha['cargaHoraria'];
        $dados['horarioIncio'] = $linha['horarioIncio'];
        $dados['horarioFIm'] = $linha['horarioFIm'];

    }
    //var_dump($dados);
    return $dados;
}

// Busca as informações digitadas no form
function dadosForm(){
    $dados = array();
    $dados['id'] = $_POST['id'];
    $dados['idInstrutor'] = $_POST['idInstrutor'];
    $dados['idAluno'] = $_POST['idAluno'];
    $dados['idVeiculo'] = $_POST['idVeiculo'];
    $dados['cargaHoraria'] = $_POST['cargaHoraria'];
    $dados['horarioIncio'] = $_POST['horarioIncio'];
    $dados['horarioFIm'] = $_POST['horarioFIm'];

    return $dados;
}