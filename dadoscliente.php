<?php
    session_start();
    include "sistemagencia.php";
    include "ajudantes.php";

    $tem_erros = false;
    $erros_validacao = array();

    if(tem_post()){

        $dado = array();

        if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
            $dado['nome'] = $_POST['nome'];
        } else {
            $tem_erros = true;
            $erros_validacao['nome'] = 'Seu Nome é obrigatório!';
        }

        if (isset($_POST['cpf']) && strlen($_POST['cpf']) > 0) {
            $dado['cpf'] = $_POST['cpf'];
        } else {
            $tem_erros = true;
            $erros_validacao['cpf'] = 'Seu CPF é obrigatório!';
        }
        
        if (isset($_POST['endereco'])) {
            $dado['endereco'] = $_POST['endereco'];
        } else {
            $dado['endereco'] = '';
        }
        
        //Número da agência fixa para um banco.
        $dado['numeroagencia'] = "0004";

        $dado['numeroconta'] = 0;

        if (! $tem_erros) {
            gravar_dados($conexao, $dado);
        
            $idgerado = mysqli_insert_id($conexao);
            $numeroconta = 16740 + $idgerado;

            $sql_update = "UPDATE dadoscliente SET numeroconta = '$numeroconta' WHERE id = '$idgerado'";
            mysqli_query($conexao, $sql_update);

            header('Location: dadoscliente.php');
            die();
        }
    }

    // Verificamos se existe algo na URL
    $busca = $_GET['busca'] ?? null;

    // Passamos a busca para a função. Se for null, ela busca tudo.
    $lista_dados = buscar_dados($conexao, $busca);
   
    include "templateagencia.php";
?>