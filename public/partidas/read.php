<?php
include('../../includes/db.php');
include('../../includes/header.php');

// Filtros
$timeFiltro = $_GET['time'] ?? '';
$dataInicio = $_GET['data_inicio'] ?? '';
$dataFim = $_GET['data_fim'] ?? '';

// Paginação
$pagina = $_GET['pagina'] ?? 1;
$itens_por_pagina = 10;
$offset = ($pagina - 1) * $itens_por_pagina;

// Consulta com filtros
$sql = "SELECT p.*, 
               tc.nome as time_casa, 
               tf.nome as time_fora 
        FROM partidas p
        JOIN times tc ON p.time_casa_id = tc.id
        JOIN times tf ON p.time_fora_id = tf.id
        WHERE 1=1";

$params = [];
$types = "";

// Filtro por time
if ($timeFiltro) {
    $sql .= " AND (tc.nome LIKE ? OR tf.nome LIKE ?)";
    $params[] = "%$timeFiltro%";
    $params[] = "%$timeFiltro%";
    $types .= "ss";
}

// Filtro por período
if ($dataInicio) {
    $sql .= " AND p.data_jogo >= ?";
    $params[] = $dataInicio;
    $types .= "s";
}
if ($dataFim) {
    $sql .= " AND p.data_jogo <= ?";
    $params[] = $dataFim;
    $types .= "s";
}

// Limite para paginação
$sql .= " LIMIT ?, ?";
$params[] = $offset;
$params[] = $itens_por_pagina;
$types .= "ii";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Partidas</h2>
<a href="create.php">Cadastrar nova partida</a>

<form method="get">
    Filtro Time: <input type="text" name="time" value="<?= htmlspecialchars($timeFiltro) ?>">
    Data Início: <input type="date" name="data_inicio" value="<?= $dataInicio ?>">
    Data Fim: <input type="date" name="data_fim" value="<?= $dataFim ?>">
    <button type="submit">Filtrar</button>
</form>

<table border="1">
    <tr>
        <th>Mandante</th>
        <th>Visitante</th>
        <th>Data</th>
        <th>Placar</th>
        <th>Ações</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['time_casa'] ?></td>
        <td><?= $row['time_fora'] ?></td>
        <td><?= $row['data_jogo'] ?></td>
        <td><?= $row['gols_casa'] ?> x <?= $row['gols_fora'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Editar</a> | 
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
    
</table>