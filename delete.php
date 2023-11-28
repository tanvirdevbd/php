<?php
include 'connect.php';

$id = $_POST['id'];
$sql = "DELETE FROM registration WHERE id=$id";

$stmt = $pdo->prepare($sql);
$data = $stmt->execute();

if ($data) {
    echo 1;
} else {
    echo 0;
}
