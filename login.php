<?php
$success = 0;
$error = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `registration`(email, password) VALUES(:email, :password)";

    $stmt = $pdo->prepare($sql);
    
    $result=$stmt->execute(['email' => $email,  'password' => $password]);

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
        <div class='w-50'>
            <form action='registration.php' method='post'>
                    <!-- email -->
                    <div class="mb-2">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- password -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Password </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login </button>
                </form>
        </div>
        <div class='w-50'>
            <img src="https://img.freepik.com/free-photo/computer-security-with-login-password-padlock_107791-16191.jpg?w=740&t=st=1699184214~exp=1699184814~hmac=b7469992dbca75115172f6379ca4c9afc37712f8cba441bd4906b1ec0a710138"
                width="600px" alt="">
        </div>
    </div>
</body>

</html>