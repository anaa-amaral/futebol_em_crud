<?php include('../../includes/db.php'); 
$id = $_GET['id'];

$sql = "DELETE FROM jogadores WHERE id=$id";
if ($conn->query($sql)) {
    echo "Jogador excluído!";
} else {
    echo "Erro: " . $conn->error;
}
?>
<a href="read.php">Voltar para lista</a>