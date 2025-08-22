<?php include('../../includes/db.php'); ?>

<h2>Cadastrar Jogador</h2>
<form method="POST">
    <label for="nome"> Nome:</label>
    <input type="text" name="nome" id="nome" required><br>

    <label for="posicao">Posição:</label>
    <select name="posicao" required>
        <option value="GOL">Goleiro</option>
        <option value="ZAG">Zagueiro</option>
        <option value="LAT">Lateral</option>
        <option value="MEI">Meio-campo</option>
        <option value="ATA">Atacante</option>
    </select><br>
 
    <label for="numero_camisa"> Número da Camisa:</label>
    <input type="number" name="numero_camisa" id="numero_camisa" min="1" max="99" required><br>

    <label for="times"> Times:</label>
    <select name="time_id">
        <?php
        $result = $conn->query("SELECT id, nome FROM times");
        while($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nome']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit" name="salvar">Salvar</button>
</form>

<?php
if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero_camisa = $_POST['numero_camisa'];
    $time_id = $_POST['time_id'];

    $sql = "INSERT INTO jogadores (nome, posicao, numero_camisa, time_id)
            VALUES ('$nome', '$posicao', $numero_camisa, $time_id)";

    if ($conn->query($sql)) {
        echo "Jogador cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>