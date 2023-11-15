<?php
include 'connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM registration WHERE id='$id'";
$stmt = $pdo->prepare($sql);
$data = $stmt->execute();

if ($data) {
    echo "<script> alert('Record deleted successfully')</script>";
?>
    <meta http-equiv='refresh' content='0;url=dashboard.php'>";
<?php
} else {
    echo "<script>alert('Record not deleted')</script>";
} ?>