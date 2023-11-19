<?php
session_start();
if ($_SESSION["id"]) {
    header("Location: dashboard.php");
}

$success = 0;
$error = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `registration` WHERE email = :email AND password = :password";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'password' => $password]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $success = 1;
        $_SESSION["user_type"] = $result['user_type'];
        $_SESSION["id"] = $result['id'];
        header("Location: dashboard.php");
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
            Login successful
            </div>';
    } else if ($error) {
        echo '<div class="alert alert-danger" role="alert">
            Wrong Email or Password
            </div>';
    }
    ?>

    <div class='container'>
        <div class='title'>
            <h1>Student Login</h1>
        </div>
        <div class='login-form-section'>
            <form action='login.php' method='post'>
                <div class='left'>
                    <!-- email -->
                    <div class="mb-4 me-2">
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Email">
                    </div>
                    <!-- password -->
                    <div class="mb-4 me-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <!-- Login button  -->
                    <button type="submit" class="reg-btn w-100">Login</button>
                    <div class=' mt-4'>
                        <p>Don't have any account? </p>
                        <a href="registration.php" class='link ms-1'>Register Now</a>
                    </div>
                </div>
                <div class='right'>
                    <img src="login.avif" alt="" width='100%' height="80%">
                </div>
            </form>
        </div>
    </div>
</body>

</html>