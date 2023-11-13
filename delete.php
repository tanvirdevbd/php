<?php
$db_username = 'root';
$db_password = '';
$conn = new PDO('mysql:host=localhost;dbname=studentforms', $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];
$sql = "DELETE FROM registration WHERE id='$id'";
$stmt = $conn->prepare($sql);
$data = $stmt->execute();

if($data){
    echo "<script> alert('Record deleted successfully')</script>";
    ?>
<meta http-equiv='refresh' content='0;url=dashboard.php'>";
<?php
 }else { echo "<script>
alert('Record not deleted')
</script>" ; } ?>