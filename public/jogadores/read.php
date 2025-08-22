<?php include('../../includes/db.php');?>

<h2>Lista de Jogadores</h2>
<a href="create.php">
    ➕ Adicionar Jogador
</a>

<h2>Lista de Jogadores</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Posição</th>
        <th>Número</th>
        <th>Time</th>
        <th>Ações</th>
    </tr>

    <?php
    $sql = "SELECT jogadores.id, jogadores.nome, jogadores.posicao, 
               jogadores.numero_camisa, times.nome AS nome_time 
        FROM jogadores
        LEFT JOIN times ON jogadores.time_id = times.id";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nome']}</td>
            <td>{$row['posicao']}</td>
            <td>{$row['numero_camisa']}</td>
            <td>{$row['nome_time']}</td>
            <td>
                <a href='update.php?id={$row['id']}'>Editar</a> |
                <a href='delete.php?id={$row['id']}'>Excluir</a>
            </td>
        </tr>";
    }
    ?>
</table>