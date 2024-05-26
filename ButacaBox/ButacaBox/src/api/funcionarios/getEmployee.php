<?php
header("Content-Type: application/json");
include '../db_connection.php';

if (isset($_GET['id'])) {
    $id_funcionario = intval($_GET['id']);
    $sql = "SELECT f.*, filiais.nome AS nome_filial FROM funcionarios AS f
            INNER JOIN filiais ON f.filial_id = filiais.id_filial
            WHERE f.id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $funcionarios = $result->fetch_assoc();
        echo json_encode($funcionarios);
    } else {
        echo json_encode(['error' => 'Funcionario não encontrado']);
    }
} else {
    $sql = "SELECT f.*, filiais.nome AS nome_filial FROM funcionarios AS f
            INNER JOIN filiais ON f.filial_id = filiais.id_filial
            ORDER BY f.id_funcionario";
    $result = $conn->query($sql);

    if ($result) {
        $funcionarios = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($funcionarios);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
