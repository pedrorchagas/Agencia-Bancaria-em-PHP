<?php
    include "sistemagencia.php";

    remover_tarefa($conexao, $_POST['id']);
    header('Location: dadoscliente.php');
?>