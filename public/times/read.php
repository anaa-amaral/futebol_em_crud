<?php 
include('../../includes/db.php');
include('../../includes/header.php'); 
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Times</h2>
        <a class="btn btn-success" href="create.php">Cadastrar Time</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM times ORDER BY nome";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['cidade']}</td>
                    <td>
                        <a href='update.php?id={$row['id']}' class='btn btn-sm btn-warning'>Editar</a>
                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Deseja realmente excluir o time {$row['nome']}?')\">Excluir</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>