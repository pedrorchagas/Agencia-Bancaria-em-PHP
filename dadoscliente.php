<?php
session_start();
require('sistemagencia.php');


if (isset($_POST['nome']) && $_POST['nome'] != '') {

    $dado = array();

    $dado['nome'] = $_POST['nome'];
    $dado['cpf'] = $_POST['cpf'] ?? '';
    $dado['endereco'] = $_POST['endereco'] ?? '';
    $dado['numeroconta'] = $_POST['numeroconta'] ?? '';
    $dado['numeroagencia'] = $_POST['numeroagencia'] ?? '';

    
    gravar_dados($mysqli, $dado);
}

$dados_clientes = buscar_dados($mysqli);

include "templateagencia.php";
?>
