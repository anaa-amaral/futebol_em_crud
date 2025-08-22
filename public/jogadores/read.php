<?php 
include('../../includes/db.php');
include('../../includes/header.php'); 
?>

<div class="d-flex justify-content-between mb-3">
    <h2>Jogadores</h2>
    <a class="btn btn-success" href="create.php">➕ Adicionar Jogador</a>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Posição</th>
            <th>Número</th>
            <th>Time</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT j.id, j.nome, j.posicao, j.numero_camisa, t.nome AS nome_time 
                FROM jogadores j
                LEFT JOIN times t ON j.time_id = t.id
                ORDER BY j.id DESC";

        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['posicao'] ?></td>
                <td><?= $row['numero_camisa'] ?></td>
                <td><?= $row['nome_time'] ?? '—' ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="update.php?id=<?= $row['id'] ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $row['id'] ?>" 
                       onclick="return confirm('Deseja realmente excluir este jogador?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>