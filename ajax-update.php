<?php
include "connect.php";
$success = 0;
$errorValue = 0;
$errorMessage = "";

$user_own_id = $_POST['user_own_id'];

$sql = "SELECT * FROM registration WHERE id=$user_own_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "images/" . $filename;
if ($folder == "images/") {
    $folder = $result['std_img'];
}
move_uploaded_file($tempname, $folder);
$std_img = $folder;

$error = array();
$extension = array("jpeg", "jpg", "png", "gif");
$maxsize = 120 * 1024;
$allImages = "";
foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
    $file_name = $_FILES["files"]["name"][$key];
    $file_tmp = $_FILES["files"]["tmp_name"][$key];
    $file_size = $_FILES["files"]["size"][$key];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    if (in_array($ext, $extension)) {
        if (count($_FILES["files"]["size"]) >= 4) {
            if ($file_size < $maxsize) {
                if (!file_exists("photo_gallery/" . $file_name)) {
                    move_uploaded_file($file_tmp, "photo_gallery/" . $file_name);
                    if (strlen($allImages)) {
                        $allImages = "$allImages," . $file_name;
                    } else {
                        $allImages = $file_name;
                    }
                } else {
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    move_uploaded_file($file_tmp, "photo_gallery/" . $newFileName);
                    if (strlen($allImages)) {
                        $allImages = "$allImages," . $newFileName;
                    } else {
                        $allImages = $newFileName;
                    }
                }
            } else {
                $errorValue = 1;
                $errorMessage = "File size is larger than 120KB. Uplaod size limit 120KB";
            }
        } else {
            $errorValue = 1;
            $errorMessage = "Less than 4 images selected";
        }
    } else {
        array_push($error, "$file_name, ");
    }
}

if ($allImages == $result['gallery_images'] || $allImages == '') {
    $gallery_images = $result['gallery_images'];
} else {
    $gallery_images = $allImages;
}


$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];

$pattern = "/^(?:\+?88)?01[3-9$]\d{8}/";
if (!preg_match($pattern, $phone)) {
    $errorValue = 1;
    $errorMessage = "Phone number is not valid BD number";
}

$email = $_POST['email'];
$password = $_POST['password'];
$retypepassword = $_POST['retypepassword'];
$class = $_POST['class'];
$gender = $_POST['gender'];
$division = $_POST['division'];
$district = "";
$upazila = "";
if (isset($_POST['district']) && isset($_POST['upazila'])) {
    $district = $_POST['district'];
    $upazila = $_POST['upazila'];
} else {
    $errorValue = 1;
    $errorMessage = "Please select your district & upazila";
}
$address = $_POST['address'];

$user_type = "";
if (isset($_POST['user_type'])) {
    $user_type = $_POST['user_type'];
}
if (!$errorValue) {
    $sql = "UPDATE `registration`
                    SET firstname=:firstname,
                    middlename=:middlename,
                    lastname=:lastname,
                    phone=:phone,
                    email=:email,
                    password=:password,
                    retypepassword=:retypepassword,
                    class=:class,
                    gender=:gender,
                    division=:division,
                    district=:district,
                    upazila=:upazila,
                    address=:address,
                    std_img=:std_img,
                    user_type=:user_type,
                    gallery_images=:gallery_images
                    WHERE id=$user_own_id";
    $stmt = $pdo->prepare($sql);

    $res = $stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'phone' => $phone, 'email' => $email, 'password' => $password, 'retypepassword' => $retypepassword, 'class' => $class, 'gender' => $gender, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'address' => $address, 'std_img' => $std_img, 'user_type' => $user_type, 'gallery_images' => $gallery_images]);

    if ($res) {
        $success = "User Updated Successfully";
    } else {
        $errorMessage = "User Update Failed";
    }
}

if ($result) {
    echo 1;
} else {
    echo 0;
}
