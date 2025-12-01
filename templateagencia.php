<html>
    <head>
        <meta charset="utf=8"/>
        <title>Agência Bancária</title>
    </head>
    <body>
        <table>
            <tr>
                <th>Banco PSGD |</th>
                <th>Número: 0428 |</th>
                <th>Endereço da Agência: Av. Alameda dos Anjos, 656, Centro, Anápolis - GO</th>
            </tr>
        </table>
        <form method="post">
            <fieldset>
                <legend>Dados do Cliente</legend>
                <label>
                    Nome:
                    <?php if($tem_erros && isset($erros_validacao['nome']))  : ?>
                        <span class="erro">
                            <?php echo $erros_validacao['nome'];?>
                        </span>
                    <?php endif; ?>
                    <input type="text" name="nome"/><br>
                </label>
                <label>
                    CPF:
                    <?php if($tem_erros && isset($erros_validacao['cpf']))  : ?>
                        <span class="erro">
                            <?php echo $erros_validacao['cpf'];?>
                        </span>
                    <?php endif; ?>
                    <input type="text" name="cpf"/><br>
                </label>
                <label>
                    Endereço:
                    <input type="text" name="endereco"/><br>
                </label>
                <label>
                    <input type="submit" value="Cadastrar"/><br>
                </label>
            </fieldset>
        </form>
        <form method="GET" action="dadoscliente.php">
            <label>Pesquisar:</label>
            <input type="text" name="busca" placeholder="Nome ou CPF...">
            <button type="submit">Buscar</button>
    
            <?php if (isset($_GET['busca'])): ?>
                <a href="dadoscliente.php">Limpar</a>
            <?php endif; ?>
        </form><br>
        <table>
            <tr>
                <th>Nome   </th>
                <th>CPF   </th>
                <th>Endereço   </th>
                <th>Número da Conta   </th>
                <th>Número da Agência   </th>
                <th>Opções  </th>
            </tr>
            <tr>
            <?php foreach ($lista_dados as $dado) : ?>
                <tr>
                    <td><?php echo $dado['nome']; ?></td>
                    <td><?php echo $dado['cpf']; ?></td>
                    <td><?php echo $dado['endereco']; ?></td>
                    <td><?php echo $dado['numeroconta']; ?></td>
                    <td><?php echo $dado['numeroagencia']; ?></td>
                    <td>
                        <form action="remover.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $dado['id']; ?>">  
                            <button type="submit">Remover</button>
                        </form>
                        <a href="operacoes.php?id=<?php echo $dado['id'];?>"> 
                            <button type="button">Acessar Conta 💰</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tr>
        </table>
    </body>
</html>