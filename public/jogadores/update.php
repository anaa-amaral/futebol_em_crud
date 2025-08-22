<?php 
include('../../includes/db.php');
include('../../includes/header.php'); 

$id = $_GET['id'];
$dados = $conn->query("SELECT * FROM jogadores WHERE id=$id")->fetch_assoc();
?>

<h2>Editar Jogador</h2>
<form method="POST">
    <label for="nome"> Nome:</label>
    <input type="text" name="nome" id="nome" required><br>

    <label for="posicao">Posição:</label> 
    <select name="posicao">
        <option <?= $dados['posicao']=="GOL"?"selected":"" ?>>GOL</option>
        <option <?= $dados['posicao']=="ZAG"?"selected":"" ?>>ZAG</option>
        <option <?= $dados['posicao']=="LAT"?"selected":"" ?>>LAT</option>
        <option <?= $dados['posicao']=="MEI"?"selected":"" ?>>MEI</option>
        <option <?= $dados['posicao']=="ATA"?"selected":"" ?>>ATA</option>
    </select><br>

    <label for="numero_camisa"> Número da Camisa:</label>
    <input type="number" name="numero_camisa" value="<?= $dados['numero_camisa'] ?>" min="1" max="99"><br>
    <button type="submit" name="atualizar">Atualizar</button>
</form>

<?php
if (isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero_camisa = $_POST['numero_camisa'];

    $sql = "UPDATE jogadores SET nome='$nome', posicao='$posicao', numero_camisa=$numero_camisa WHERE id=$id";

    if ($conn->query($sql)) {
        echo "Jogador atualizado!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>