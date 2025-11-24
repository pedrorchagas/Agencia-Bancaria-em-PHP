<?php

$bdServidor = '127.0.0.1';
$bdUsuario = 'agenciabancaria';
$bdSenha = 'bancopsgd';
$bdBanco = 'agenciabancaria';

$mysqli = new mysqli($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

function buscar_dados($conexao){
    $sql = "SELECT * FROM agenciabancaria";

    $resultado = $conexao->query($sql);

    $dados = [];
    while ($dado = $resultado->fetch_assoc()) {
        $dados[] = $dado;
    }

    return $dados;
}

function gravar_dados($conexao, $dado){
    $sql = "
        INSERT INTO dadosclientes
        (nome, cpf, endereco, numeroconta, numeroagencia)
        VALUES (
            '{$dado['nome']}',
            '{$dado['cpf']}',
            '{$dado['endereco']}',
            '{$dado['numeroconta']}',
            '{$dado['numeroagencia']}'
        )
    ";

    return $conexao->query($sql);
}
?>
