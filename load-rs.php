<?php
include 'connect.php';

$sql = "SELECT * FROM registration";

$stmt = $pdo->prepare($sql);

$stmt->execute();
$str = "";
$rowNum = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $rowNum++;
    $trSingle = "
    <tr>
        <th scope='row'>{$rowNum}</th>       
        <td>
            <img src='{$row['std_img']}' alt='Profile image' width='100' height='100'>
        </td>
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
            <a href='update-registered-students.php?id={$row['id']}'>
             <button class='btn btn-warning mb-2'>Update </button>
            </a>
             <a href='delete.php?id={$row['id']}'>
             <button class='btn btn-danger' onclick='return checkdelete()'>Delete </button>
            </a>
        </td>    
    </tr>
    ";
    $str .= $trSingle;
}
echo $str;
