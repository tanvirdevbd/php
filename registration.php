<?php
$success = 0;
$error = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
    
    $result=$stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname,'phone' => $phone,  'email' => $email,  'password' => $password,  'retypepassword' => $retypepassword, 'class' => $class, 'gender' => $gender, 'upazila' => $upazila, 'zila' => $zila, 'address' => $address]);

    if($result){
        $success = 1;
    }
    else{
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
        if($success){
            echo '<div class="alert alert-success" role="alert">
            Registration successful
            </div>';
        }       
        else if($error){
            echo '<div class="alert alert-danger" role="alert">
            Registration failed
            </div>';
        }       
    ?>
    <div class="d-flex my-2">
        <div class="mt-5">
            <img src="https://www.indiafilings.com/learn/wp-content/uploads/2023/01/shutterstock_257823118-1.jpg"
                width="600px" alt="">
        </div>
        <div>
            <div class='container mb-2'>
                <form action='registration.php' method='post'>
                    <div class='d-flex'>

                        <!-- firstname  -->
                        <div class="mb-2 me-2">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>

                        <!-- middlename  -->
                        <div class="mb-2 me-2">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>

                        <!-- lastname  -->
                        <div class="mb-2 me-2">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>
                    </div>

                   <div class='d-flex'>
                     <!-- phone  -->
                     <div class="mb-2 me-4 w-50">
                        <label for="phone" class="form-label">Phone </label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                     <!-- email -->
                     <div class="mb-2 w-50">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                   </div>

                    <!-- password -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Password </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- re type password -->
                    <div class="mb-2">
                        <label for="retypepassword" class="form-label">Re-type Password</label>
                        <input type="password" class="form-control" id="retypepassword" name="retypepassword" required>
                    </div>

                    <!-- class  -->
                    <div class="mb-2">
                        <label for="class" class="form-label me-5">Class: </label>
                        <select name="class" id="class  w-100">
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
                        </select>
                    </div>

                    <!-- gender  -->
                    <div class="mb-2 d-flex">
                        <label for="gender" class="form-label me-3 align-items-center">Gender:  </label> <br/>
                        <input type="radio" id="male" name="gender" value="MALE">
                        <label for="html" class='mx-2'>Male</label><br>
                        <input type="radio" id="female" name="gender" value="FEMALE">
                        <label for="html" class='mx-2'>Female</label><br>
                        <input type="radio" id="others" name="gender" value="OTHERS">
                        <label for="html"  class='mx-2'>Others</label><br>
                    </div>

                    <!-- zila  -->
                    <div class="mb-2">
                        <label for="zila" class="form-label me-5">Zila:  </label>
                        <select name="zila" id="zila">
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
                        <label for="upazila" class="form-label me-3">Upazila:  </label>
                        <select name="upazila" id="upazila">
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
                        <label for="address" class="form-label">Address </label>
                        <textarea class="form-control" id="address" name="address" rows="1" cols="50"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>