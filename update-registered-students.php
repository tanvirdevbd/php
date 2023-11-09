<?php
$db_username = 'root';
$db_password = '';

$conn = new PDO('mysql:host=localhost;dbname=studentforms', $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM registration WHERE id={$_GET['id']}";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$success = 0;
$error = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                    address=:address
     WHERE id={$result['id']}";

    $stmt = $conn->prepare($sql);

    $res = $stmt->execute(['firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'phone' => $phone,  'email' => $email,  'password' => $password, 'retypepassword' => $retypepassword,  'class' => $class, 'gender' => $gender, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'address' => $address]);

    if ($res) {
        $success = 1;
    } else {
        $error = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <?php
    if ($success) {
        echo '<div class="alert alert-success" role="alert">
            Updated successfully
            </div>';
        // header('Location: dashboard.php');
        echo "<meta http-equiv='refresh' content='0;url=dashboard.php'>";
        die;
    } else if ($error) {
        echo '<div class="alert alert-danger" role="alert">
            Update failed
            </div>';
    }
    ?>

    <div class='container'>
        <div class='title'>
            <h1>Update Student Reg. Info.</h1>
        </div>
        <div class='form-section'>
            <form method='post'>
                <div class='left'>
                    <!-- firstname  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value="<?php echo $result['firstname'] ? $result['firstname'] : '' ?>">
                    </div>

                    <!-- middlename  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middle Name" value="<?php echo $result['middlename'] ?>">
                    </div>

                    <!-- lastname  -->
                    <div class="mb-2 me-2">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="<?php echo $result['lastname'] ?>">
                    </div>
                    <!-- email -->
                    <div class="mb-2  me-2">
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Email" value="<?php echo $result['email'] ?>">
                    </div>
                    <!-- password -->
                    <div class="mb-2  me-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required value="<?php echo $result['password'] ?>">
                    </div>
                    <!-- re type password -->
                    <div class="mb-2 me-2">
                        <input type="password" class="form-control" id="retypepassword" name="retypepassword" required placeholder="Re Enter Password" value="<?php echo $result['retypepassword'] ?>">
                    </div>
                    <!-- phone  -->
                    <div class=" mb-2 me-2">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $result['phone'] ?>">
                    </div>

                    <!-- gender  -->
                    <div class="mb-2">
                        <label for="gender" class="form-label me-3 name">Gender: </label>
                        <input type="radio" id="male" name="gender" value="MALE" <?php echo ($result['gender'] == 'MALE') ? 'checked' : '' ?>>
                        <label for="html" class='mx-1'>Male</label>
                        <input type="radio" id="female" name="gender" value="FEMALE" <?php echo ($result['gender'] == 'FEMALE') ? 'checked' : '' ?>>
                        <label for="html" class='mx-1'>Female</label>
                        <input type="radio" id="others" name="gender" value="OTHERS" <?php echo ($result['gender'] == 'OTHERS') ? 'checked' : '' ?>>
                        <label for="html" class='mx-1'>Others</label>
                    </div>
                </div>
                <div class='right'>
                    <!-- class  -->
                    <div class="mb-2">
                        <label for="class" class="form-label me-4 name">Class: </label>
                        <select name="class" id="class" class="select-area">
                            <?php
                            $sql = "SELECT * FROM class_tb";

                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo ($result['class'] == $row['id']) ? "selected" : ""; ?>><?php echo $row['name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- division  -->
                    <div class="mb-2">
                        <label for="division" class="form-label me-2 name">Division: </label>
                        <select name="division" id="division" class="select-area">
                            <option value="">Select Division</option>
                            <?php
                            $sql = "SELECT * FROM division_tb";

                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo ($result['division'] == $row['id']) ? "selected" : ""; ?>><?php echo $row['name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <!-- district  -->
                    <div class="mb-2">
                        <label for="district" class="form-label me-3  name">District: </label>
                        <select name="district" id="district" class="select-area">
                            <?php

                            $sql = "SELECT * FROM district_tb";

                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo ($result['district'] == $row['id']) ? "selected" : ""; ?>><?php echo $row['name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <!-- upazila  -->
                    <div class="mb-2">
                        <label for="upazila" class="form-label me-3 name">Upazila: </label>
                        <select name="upazila" id="upazila" class="select-area">
                            <?php

                            $sql = "SELECT * FROM upazila_tb";

                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo ($result['upazila'] == $row['id']) ? "selected" : ""; ?>><?php echo $row['name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <!-- address  -->
                    <div class="mb-2">
                        <textarea class="form-control me-2" id="address" name="address" rows="3" cols="50" placeholder="Enter Address">
                           <?php echo $result['address'] ?>
                        </textarea>
                    </div>
                    <!-- register button  -->
                    <button type="submit" class="reg-btn w-100">Update </button>
                </div>
            </form>
        </div>
    </div>
    </script>
</body>

</html>