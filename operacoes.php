<?php
    session_start();
    include "sistemagencia.php";

    // 1. Verifica se temos um ID de cliente selecionado
    if (!isset($_GET['id'])) {
        echo "Erro: Cliente não selecionado.";
        exit;
    }

    $id = $_GET['id'];
    $mensagem = "";

    //LÓGICA DAS OPERAÇÕES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $tipo_operacao = $_POST['tipo'];
        $valor = (float) $_POST['valor'];

        //Depósitos e Saques não podem ser zero ou negativos
        if ($valor <= 0) {
            $mensagem = "Erro: O valor deve ser maior que zero!";
        } else {
        
        
            $sql = "SELECT * FROM dadoscliente WHERE id = $id";
            $resultado = mysqli_query($conexao, $sql);
            $cliente = mysqli_fetch_assoc($resultado);

            //DEPÓSITO
            if ($tipo_operacao == 'deposito') {
                $novo_saldo = $cliente['saldo'] + $valor;
                $sql_update = "UPDATE dadoscliente SET saldo = '$novo_saldo' WHERE id = $id";
                mysqli_query($conexao, $sql_update);
                $mensagem = "Sucesso: Depósito de R$ $valor realizado!";
            }

            //SAQUE
            elseif ($tipo_operacao == 'saque') {
            //Saque não pode exceder o saldo
                if ($valor > $cliente['saldo']) {
                    $mensagem = "Erro: Saldo insuficiente para sacar R$ $valor.";
                } else {
                    $novo_saldo = $cliente['saldo'] - $valor;
                    $sql_update = "UPDATE dadoscliente SET saldo = '$novo_saldo' WHERE id = $id";
                    mysqli_query($conexao, $sql_update);
                    $mensagem = "Sucesso: Saque de R$ $valor realizado!";
                }
            }

            //TRANSFERÊNCIA
            elseif ($tipo_operacao == 'transferencia') {
                $conta_destino = $_POST['conta_destino'];

                //Tem saldo?
                if ($valor > $cliente['saldo']) {
                    $mensagem = "Erro: Saldo insuficiente para transferir.";
                } else {
                    // Verificar se a conta destino existe
                    $sql_busca_destino = "SELECT id FROM dadoscliente WHERE numeroconta = '$conta_destino'";
                    $res_destino = mysqli_query($conexao, $sql_busca_destino);
                
                    if (mysqli_num_rows($res_destino) > 0) {
                        $dados_destino = mysqli_fetch_assoc($res_destino);
                        $id_destino = $dados_destino['id'];

                        $sql_tira = "UPDATE dadoscliente SET saldo = saldo - $valor WHERE id = $id";
                        mysqli_query($conexao, $sql_tira);
                    
                        $sql_poe = "UPDATE dadoscliente SET saldo = saldo + $valor WHERE id = $id_destino";
                        mysqli_query($conexao, $sql_poe);

                        $mensagem = "Sucesso: Transferência realizada para conta $conta_destino!";
                    } else {
                        $mensagem = "Erro: Conta de destino não encontrada.";
                    }
                }
            }
        }
    }


    $sql = "SELECT * FROM dadoscliente WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql);
    $cliente = mysqli_fetch_assoc($resultado);

    include "templateoperacoes.php";
?>
