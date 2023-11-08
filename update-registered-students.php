<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    die();
}

echo "<b class='page-title'>Update </b>" .  $_SESSION['email']
?>

<a href="logout.php">Logout</a>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/dashboard.css">
</head>

<body>
    <div class='container'>
        <div class='title'>
            <h1>Update Student Reg.</h1>
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

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadData() {
                $.ajax({
                    url: 'registered-students.php',
                    type: 'POST',
                    success: function(data) {
                        $("#registered_students").html(data)
                    }
                });
            }
            loadData();
        })
    </script>
</body>

</html>