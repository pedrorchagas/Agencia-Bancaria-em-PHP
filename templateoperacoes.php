<html>
<head>
    <title>Painel da Conta</title>
</head>
<body>

    <h1>Olá, <?php echo $cliente['nome']; ?></h1>
    <h2>Conta: <?php echo $cliente['numeroconta']; ?> | Agência: <?php echo $cliente['numeroagencia']; ?></h2>
    
    <div style="background-color: #e0f7fa; padding: 20px; border: 1px solid #00acc1;">
        <h3>Saldo Atual: R$ <?php echo number_format($cliente['saldo'], 2, ',', '.'); ?></h3>
    </div>

    <?php if ($mensagem): ?>
        <p style="color: red; font-weight: bold;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <hr>

    <h3>Fazer Depósito</h3>
    <form method="POST">
        <input type="hidden" name="tipo" value="deposito">
        Valor: <input type="number" name="valor" step="0.01" required>
        <button type="submit">Depositar</button>
    </form>

    <h3>Fazer Saque</h3>
    <form method="POST">
        <input type="hidden" name="tipo" value="saque">
        Valor: <input type="number" name="valor" step="0.01" required>
        <button type="submit">Sacar</button>
    </form>

    <h3>Transferência (DOC/TED/PIX)</h3>
    <form method="POST">
        <input type="hidden" name="tipo" value="transferencia">
        Valor: <input type="number" name="valor" step="0.01" required> <br><br>
        Conta de Destino: <input type="text" name="conta_destino" required placeholder="Digite o número da conta">
        <button type="submit">Transferir</button>
    </form>

    <br><br>
    <a href="dadoscliente.php">Voltar para a Lista de Clientes</a>
</body>
</html>