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
    $division = $_POST['division'];
    $district = $_POST['district'];
    $upazila = $_POST['upazila'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `registration`(firstname, middlename, lastname, phone, email, password, retypepassword, class, gender, division, district, upazila, address) VALUES(:firstname, :middlename, :lastname, :phone, :email, :password, :retypepassword, :class, :gender, :division, :district, :upazila,  :address)";

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'phone' => $phone,  'email' => $email,  'password' => $password,  'retypepassword' => $retypepassword, 'class' => $class, 'gender' => $gender, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'address' => $address]);

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

                </div>
                <div class='right'>

                    <!-- class  -->
                    <div class="mb-2">
                        <label for="class" class="form-label me-4 name">Class: </label>
                        <select name="class" id="class" class="select-area">
                        </select>
                    </div>

                    <!-- division  -->
                    <div class="mb-2">
                        <label for="division" class="form-label me-2 name">Division: </label>
                        <select name="division" id="division" class="select-area">
                            <option value="">Select Division</option>
                        </select>
                    </div>
                    <!-- district  -->
                    <div class="mb-2">
                        <label for="district" class="form-label me-3  name">District: </label>
                        <select name="district" id="district" class="select-area">
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- upazila  -->
                    <div class="mb-2">
                        <label for="upazila" class="form-label me-3 name">Upazila: </label>
                        <select name="upazila" id="upazila" class="select-area">
                            <option value=""></option>
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

    <script type="text/javascript" src="jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type, category_id) {
                $.ajax({
                    url: 'load-cs.php',
                    type: 'POST',
                    data: {
                        type: type,
                        id: category_id
                    },
                    success: function(data) {
                        if (type === "upazilaData") {
                            $("#upazila").html(data)
                        } else if (type === "districtData") {
                            $("#district").html(data)
                        } else {
                            $("#division").append(data)
                        }
                    }
                });
            }
            loadData();

            $("#division").on("change", function() {
                var division = $("#division").val();
                if (division != "") {
                    loadData("districtData", division);
                } else {
                    $("#district").html("");
                }
            })

            $("#district").on("change", function() {
                var district = $("#district").val();
                if (district != "") {
                    loadData("upazilaData", district);
                } else {
                    $("#upazila").html("");
                }
            })

            function loadClass() {
                $.ajax({
                    url: 'load-cs.php',
                    type: 'POST',
                    data: {
                        type: "classData"
                    },
                    success: function(data) {
                        $("#class").html(data)
                    }
                });
            }
            loadClass();
        })
    </script>
</body>

</html>