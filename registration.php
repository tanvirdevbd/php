<?php
$success = 0;
$error = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retypepassword = $_POST['retypepassword'];
    $class = $_POST['class'];
    $gender = $_POST['gender'];
    $upazila = $_POST['upazila'];
    $zila = $_POST['zila'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `registration`(firstname, middlename, lastname, phone, email, password, retypepassword, class, gender, zila, upazila, address) VALUES(:firstname, :middlename, :lastname, :phone, :email, :password, :retypepassword, :class, :gender, :upazila, :zila, :address)";

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'phone' => $phone,  'email' => $email,  'password' => $password,  'retypepassword' => $retypepassword, 'class' => $class, 'gender' => $gender, 'upazila' => $upazila, 'zila' => $zila, 'address' => $address]);

    if ($result) {
        $success = 1;
    } else {
        $error = 1;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    if ($success) {
        echo '<div class="alert alert-success" role="alert">
            Registration successful
            </div>';
    } else if ($error) {
        echo '<div class="alert alert-danger" role="alert">
            Registration failed
            </div>';
    }
    ?>

    <div class='container'>
        <div class='title'>
            <h1>Student Registration</h1>
        </div>
        <div class='form-section'>
            <form action='registration.php' method='post'>
                <div class='left'>
                    <!-- firstname  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name">
                    </div>

                    <!-- middlename  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middle Name">
                    </div>

                    <!-- lastname  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name">
                    </div>
                    <!-- email -->
                    <div class="mb-2  me-2">
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Email">
                    </div>
                    <!-- password -->
                    <div class="mb-2  me-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                    </div>

                    <!-- re type password -->
                    <div class="mb-2 me-2">
                        <input type="password" class="form-control" id="retypepassword" name="retypepassword" required placeholder="Re Enter Password">
                    </div>
                    <!-- phone  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class='right'>

                    <!-- class  -->
                    <div class="mb-2">
                        <label for="class" class="form-label me-4  name">Class: </label>
                        <select name="class" id="class" class="select-area">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <!-- gender  -->
                    <div class="mb-2">
                        <label for="gender" class="form-label me-3 name">Gender: </label>
                        <input type="radio" id="male" name="gender" value="MALE">
                        <label for="html" class='mx-1'>Male</label>
                        <input type="radio" id="female" name="gender" value="FEMALE">
                        <label for="html" class='mx-1'>Female</label>
                        <input type="radio" id="others" name="gender" value="OTHERS">
                        <label for="html" class='mx-1'>Others</label>
                    </div>
                    <!-- zila  -->
                    <div class="mb-2">
                        <label for="zila" class="form-label me-5  name">Zila: </label>
                        <select name="zila" id="zila" class="select-area">
                            <option value="dhaka">Dhaka</option>
                            <option value="faridpur">Faridpur</option>
                            <option value="gazipur">Gazipur</option>
                            <option value="gopalganj">Gopalganj</option>
                            <option value="narayanganj">Narayanganj</option>
                            <option value="barisal">Barisal</option>
                            <option value="pirojpur">Pirojpur</option>
                            <option value="khulna">Khulna</option>
                            <option value="kushtia">Kushtia</option>
                            <option value="magura">Magura</option>
                            <option value="satkhira">Satkhira</option>
                            <option value="jashore">jashore</option>
                        </select>
                    </div>
                    <!-- upazila  -->
                    <div class="mb-2">
                        <label for="upazila" class="form-label me-3 name">Upazila: </label>
                        <select name="upazila" id="upazila" class="select-area">
                            <option value="gazipur-s">Gazipur-S</option>
                            <option value="patuakhali-s">Patuakhali-S</option>
                            <option value="nabinagar">Nabinagar</option>
                            <option value="bandarban-s">Bandarban-S</option>
                            <option value="chandpur-s">Chandpur-S</option>
                            <option value="coxsbazar-s">Cox'S Bazar-S</option>
                            <option value="teknaf">Teknaf</option>
                            <option value="ukhiya">Ukhiya</option>
                            <option value="titas">Titas</option>
                            <option value="kaptai">Kaptai</option>
                            <option value="faridpur-s">Faridpur-S</option>
                            <option value="barishal-s">Barishal-S</option>
                            <option value="gopalganj-s">Gopalganj-S</option>
                            <option value="madaripur-s">Madaripur-S</option>
                            <option value="manikganj-s">Manikganj-S</option>
                            <option value="munshiganj-s">Munshiganj-S</option>
                            <option value="narayanganj-s">Narayanganj-S</option>
                            <option value="rajbari-s">Rajbari-S</option>
                            <option value="jashore-s">Jashore-S</option>
                            <option value="chuadanga-s">Chuadanga-S</option>
                            <option value="kushtia-s">Kushtia-S</option>
                            <option value="mirpur">Mirpur</option>
                            <option value="jamalganj">Jamalganj</option>
                            <option value="golapganj">Golapganj</option>
                        </select>
                    </div>
                    <!-- address  -->
                    <div class="mb-2">
                        <textarea class="form-control me-2" id="address" name="address" rows="3" cols="50" placeholder="Enter Address"></textarea>
                    </div>
                    <!-- register button  -->
                    <button type="submit" class="reg-btn w-100">Register</button>
                    <div class='d-flex mt-2'>
                        <p>Already have an account? </p>
                        <a href="login.php" class='link ms-1'>Login Now</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>