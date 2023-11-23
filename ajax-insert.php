<?php
$firstname = $_POST["firstname"];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];   
$password = $_POST['password'];
$retypepassword = $_POST['retypepassword'];
$phone = $_POST['phone'];
$class = $_POST['classNum'];
$division = $_POST['division'];
$district = $_POST['district'];
$upazila = $_POST['upazila'];
$address = $_POST['address'];

// $filename = $_FILES["uploadfile"]["name"];
// $tempname = $_FILES["uploadfile"]["tmp_name"];
// $folder = "images/" . $filename;
// move_uploaded_file($tempname, $folder);
// $std_img = $folder;

$sql = "INSERT INTO `registration`(firstname, middlename, lastname, phone, email, password, retypepassword, class, division, district, upazila, address) VALUES(:firstname, :middlename, :lastname, :phone, :email, :password, :retypepassword, :class, :division, :district, :upazila,  :address)";

$stmt = $pdo->prepare($sql);

$result = $stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'phone' => $phone,  'email' => $email,  'password' => $password,  'retypepassword' => $retypepassword, 'class' => $class, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'address' => $address]);

if ($result) {
    echo 1;
}else{
    echo 0;
}

?>