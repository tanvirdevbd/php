<?php
include 'connect.php';

if ($_POST['type'] == "classData") {
    $sql = "SELECT * FROM class_tb";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else if ($_POST['type'] == "") {
    $sql = "SELECT * FROM division_tb";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else if ($_POST['type'] == "districtData") {
    $sql = "SELECT * FROM district_tb WHERE division_id = {$_POST['id']}";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else if ($_POST['type'] == "upazilaData") {
    $sql = "SELECT * FROM upazila_tb WHERE district_id = {$_POST['id']}";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}
echo $str;
