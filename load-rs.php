<?php
session_start();
include 'connect.php';

$sessionUser = $_SESSION['user_type'];
$sessionId = $_SESSION['id'];
$gallery_imagesArr = [];

// var_dump($_POST['type']);
// die();

if ($sessionUser && $_POST['type'] == "search") {
    $searchedTerm = $_POST['id'];
    $sql = "SELECT * FROM registration WHERE firstname =:firstname OR phone=:phone ";
    $stmt = $pdo->prepare($sql);
    $res11 = $stmt->execute(['firstname' => $searchedTerm, 'phone' => $searchedTerm]);
    $str = "";
    $rowNum = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $gallery_imagesArr = explode(',', $row['gallery_images']);
        $rowNum++;
        $trSingle = "
        <tr>
            <th scope='row'>{$rowNum}</th>       
            <td>
                <img src='{$row['std_img']}' alt='Profile image'  width='80' height='80' style='border-radius: 50%;'>
            </td>
            <td class='d-flex'>";
        if (count($gallery_imagesArr)) {
            foreach ($gallery_imagesArr as $x => $singleImage) {
                $trSingle .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' style='border-radius: 50%;'>";
            }
        }
        $trSingle .= "
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
            <td>";
        if ($row['user_type'] == 1) {
            $trSingle .= 'Admin';
        } else if ($row['user_type'] == 0) {
            $trSingle .= 'Student';
        }
        $trSingle .=  "</td>
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
} else if ($sessionUser  && $_POST['type'] == "") {
    $sql = "SELECT * FROM registration";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $str = "";
    $rowNum = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $gallery_imagesArr = explode(',', $row['gallery_images']);
        $rowNum++;
        $trSingle = "
    <tr>
        <th scope='row'>{$rowNum}</th>       
        <td>
            <img src='{$row['std_img']}' alt='Profile image'  width='80' height='80' style='border-radius: 50%;'>
        </td>
        <td class='d-flex'>";
        if (count($gallery_imagesArr)) {
            foreach ($gallery_imagesArr as $x => $singleImage) {
                $trSingle .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' style='border-radius: 50%;'>";
            }
        }
        $trSingle .= "
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
        <td>";
        if ($row['user_type'] == 1) {
            $trSingle .= 'Admin';
        } else if ($row['user_type'] == 0) {
            $trSingle .= 'Student';
        }
        $trSingle .=  "</td>
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
    $sql = "SELECT * FROM registration WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $sessionId]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $rowNum = 1;
    $str = "
    <tr>
        <th scope='row'>{$rowNum}</th>       
        <td>
            <img src='{$res['std_img']}' alt='Profile image' width='80' height='80' style='border-radius: 50%;'>
        </td>
        <td class='d-flex'>";

    $gallery_imagesArr = explode(',', $res['gallery_images']);
    if (count($gallery_imagesArr)) {
        foreach ($gallery_imagesArr as $x => $singleImage) {
            $str .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' style='border-radius: 50%;'>";
        }
    }
    $str .= "
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
