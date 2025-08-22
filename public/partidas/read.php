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

<div class="d-flex justify-content-between mb-3">
    <h2>Partidas</h2>
    <a class="btn btn-success" href="create.php">Cadastrar Partida</a>
</div>

<form class="row g-3 mb-3" method="get">
    <div class="col-md-4">
        <input type="text" name="time" class="form-control" placeholder="Filtro por Time" value="<?= htmlspecialchars($timeFiltro) ?>">
    </div>
    <div class="col-md-3">
        <input type="date" name="data_inicio" class="form-control" value="<?= $dataInicio ?>">
    </div>
    <div class="col-md-3">
        <input type="date" name="data_fim" class="form-control" value="<?= $dataFim ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
</form>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Mandante</th>
            <th>Visitante</th>
            <th>Data</th>
            <th>Placar</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['time_casa'] ?></td>
            <td><?= $row['time_fora'] ?></td>
            <td><?= $row['data_jogo'] ?></td>
            <td><?= $row['gols_casa'] ?> x <?= $row['gols_fora'] ?></td>
            <td>
                <a class="btn btn-sm btn-warning" href="update.php?id=<?= $row['id'] ?>">Editar</a>
                <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>