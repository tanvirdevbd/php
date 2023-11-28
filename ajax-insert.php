<?php
include "connect.php";

$firstname = $_POST["firstname"];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$retypepassword = $_POST['retypepassword'];

//TODO: phone number validation & toast message meaningful send to jquery 
$phone = $_POST['phone'];

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "images/" . $filename;
move_uploaded_file($tempname, $folder);
$std_img = $folder;

$gender = $_POST['gender'];
$user_type = $_POST['user_type'];
$class = $_POST['class'];
$division = $_POST['division'];
$district = $_POST['district'];
$upazila = $_POST['upazila'];
$address = $_POST['address'];

$sql = "INSERT INTO `registration`(firstname, middlename, lastname, email, password, retypepassword, phone, std_img, gender, user_type, class, division, district, upazila, address) VALUES(:firstname, :middlename, :lastname, :email, :password, :retypepassword, :phone, :std_img, :gender, :user_type, :class, :division, :district, :upazila, :address)";

$stmt = $pdo->prepare($sql);

$result = $stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'email' => $email,  'password' => $password,  'retypepassword' => $retypepassword, 'phone' => $phone, 'std_img' => $std_img, 'gender' => $gender,  'user_type' => $user_type, 'class' => $class, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'address' => $address]);

if ($result) {
    echo 1;
} else {
    echo 0;
}
