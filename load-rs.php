<?php
session_start();
include 'connect.php';
$sessionEmail = $_SESSION['email'];
$sql = "SELECT * FROM registration WHERE email=:email";

$stmt = $pdo->prepare($sql);

$stmt->execute(['email' => $sessionEmail]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$res['user_type']) {
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
        <td>{$row['user_type']}</td>
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
} else {
    $rowNum = 1;
    $str = "
    <tr>
        <th scope='row'>{$rowNum}</th>       
        <td>
            <img src='{$res['std_img']}' alt='Profile image' width='100' height='100'>
        </td>
        <td>{$res['firstname']}</td>
        <td>{$res['middlename']}</td>
        <td>{$res['lastname']}</td>
        <td>{$res['phone']}</td>
        <td>{$res['class']}</td>
        <td>{$res['gender']}</td>
        <td>{$res['division']}</td>
        <td>{$res['district']}</td>
        <td>{$res['upazila']}</td>
        <td>{$res['address']}</td>
        <td>{$res['email']}</td>
        <td>{$res['password']}</td>
        <td>{$res['user_type']}</td>
        <td>
            <a href='update-registered-students.php?id={$res['id']}'>
             <button class='btn btn-warning mb-2'>Update </button>
            </a>
             <a href='delete.php?id={$res['id']}'>
             <button class='btn btn-danger' onclick='return checkdelete()'>Delete </button>
            </a>
        </td>    
    </tr>
    ";
    echo $str;
}
