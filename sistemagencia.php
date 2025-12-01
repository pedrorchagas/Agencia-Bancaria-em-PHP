<?php

    $bdServidor = '127.0.0.1';
    $bdUsuario = 'agenciabancaria';
    $bdSenha = 'bancopsgd';
    $bdBanco = 'agenciabancaria';

    $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

    if (mysqli_connect_errno()){
        echo "Problemas para conectar no banco. Tente Novamente!";
        exit();
    }

    
    function buscar_dados($conexao, $busca = null){
    
        if ($busca) {
        //Se tem busca, filtramos por Nome OU CPF
        //O símbolo % serve para dizer "qualquer coisa antes ou depois"
        //Ex: %Gab% acha "Gabriel", "Gabriela", "João Gabriel"
        
            $busca = mysqli_real_escape_string($conexao, $busca); // Proteção básica
            $sqlBusca = "SELECT * FROM dadoscliente 
                WHERE nome LIKE '%$busca%' 
                OR cpf LIKE '%$busca%'";
        } else {
        // Se não tem busca, traz tudo como antes
            $sqlBusca = 'SELECT * FROM dadoscliente';
        }

        $resultado = mysqli_query($conexao, $sqlBusca);

        $dados = array();

        while($dado = mysqli_fetch_assoc($resultado)){
            $dados[] = $dado;
        }

        return $dados;
    }

    function gravar_dados($conexao, $dado){
        $sqlGravar = "
            INSERT INTO dadoscliente
            (nome, cpf, endereco, numeroconta, numeroagencia)
            VALUES (
                '{$dado['nome']}',
                '{$dado['cpf']}',
                '{$dado['endereco']}',
                '{$dado['numeroconta']}',
                '{$dado['numeroagencia']}'
            )";
    
        return $conexao->query($sqlGravar);
    }

    function remover_tarefa($conexao, $id){
        $sqlRemover = "DELETE FROM dadoscliente WHERE id = {$id}";
        mysqli_query($conexao, $sqlRemover);
    }

?>
