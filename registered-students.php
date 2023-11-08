<?php
$db_username = 'root';
$db_password = '';

$conn = new PDO('mysql:host=localhost;dbname=studentforms', $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM registration";

$stmt = $conn->prepare($sql);

$stmt->execute();

$str = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $trSingle = "
    <tr>
        <th scope='row'>{$row['id']}</th>
        <td>{$row['firstname']}</td>
        <td>{$row['middlename']}</td>
        <td>{$row['lastname']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['class']}</td>
        <td>{$row['gender']}</td>
        <td>{$row['division']}</td>
        <td>{$row['district']}</td>
        <td>{$row['upazila']}</td>
        <td>{$row['address']}</td>
        <td>{$row['email']}</td>
        <td>{$row['password']}</td>
        <td>
            <a href='update-registered-students.php'>Edit</a>
        </td>    
    </tr>
    ";
    $str .= $trSingle;
}
echo $str;
