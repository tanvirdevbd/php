<?php
$db_username = 'root';
$db_password = '';
$conn = new PDO('mysql:host=localhost;dbname=studentforms', $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    die();
}

echo "<b>Welcome </b>" .  $_SESSION['email'];

$sql = "SELECT * FROM registration WHERE email='{$_SESSION['email']}'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$success = 0;
$error = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    if ($oldPassword == $result['password']) {
        if (strlen($newPassword) < 8) {
            $error = "New Password length not greater than 6";
        } else if (!preg_match('@[A-Z]@', $newPassword)) {
            $error = "Uppercase not included";
        } else if (!preg_match('@[a-z]@', $newPassword)) {
            $error = "lowercase not included";
        } else if (!preg_match('@[0-9]@', $newPassword)) {
            $error = "number not included";
        } else if ($newPassword != $confirmNewPassword) {
            $error = "New Password not matched";
        } else {
            $sql = "UPDATE `registration`
                        SET password=:password
                        WHERE email='{$_SESSION['email']}'";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute(['password' => $newPassword]);
            if ($res) {
                $success = "New Password updated successfully";
            } else {
                $error = "New Password not updated";
            }
        }
    } else {
        $error = "Old Password not matched";
    }
}

?>
<a href="logout.php">
    <button class="btn btn-primary">Logout </button>
</a>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="profile.css">
</head>

<body>

    <?php
    if ($success) {
        echo '<div class="alert alert-success" role="alert">'
            . $success .
            '</div>';
        echo "<meta http-equiv='refresh' content='0;url=dashboard.php'>";;
        die;
    } else if ($error) {
        echo "<div class='alert alert-danger' role='alert'>"
            . $error .
            "</div>";
    }
    ?>
    <div class='container'>
        <div class='title'>
            <h1 class='mt-4'>Change Password</h1>
        </div>
        <div class='form-section'>
            <form method='post'>
                <!-- old password -->
                <div class="mb-2 me-2">
                    <label for="old-password"> Old Password</label>
                    <div class="d-flex">
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter Old Password" required><i class="bi bi-eye-slash mt-2 ms-0" id="toggleOldPassword"></i>
                    </div>
                </div>
                <!-- new password -->
                <div class="mb-2 me-2">
                    <label for="new-password"> New Password</label>
                    <div class="d-flex">
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password"> <i class="bi bi-eye-slash mt-2 ms-0" id="toggleNewPassword"></i>
                    </div>
                </div>

                <!-- confirm new password -->
                <div class="mb-2 me-2">
                    <label for="confirm-new-password"> Confirm new Password</label>
                    <div class="d-flex">
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password"> <i class="bi bi-eye-slash mt-2 ms-0" id="toggleConfirmNewPassword"></i>
                    </div>
                </div>
                <!-- update button  -->
                <button type="submit" class="btn btn-primary w-100">Update Password </button>
        </div>
        </form>
    </div>
    <script>
        const toggleOldPassword = document.querySelector('#toggleOldPassword');
        const oldPassword = document.querySelector('#oldPassword');

        const toggleNewPassword = document.querySelector('#toggleNewPassword');
        const newPassword = document.querySelector('#newPassword');

        const toggleConfirmNewPassword = document.querySelector('#toggleConfirmNewPassword');
        const confirmNewPassword = document.querySelector('#confirmNewPassword');

        toggleOldPassword.addEventListener('click', () => {
            const type = oldPassword
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            oldPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });

        toggleNewPassword.addEventListener('click', () => {
            const type = newPassword
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            newPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });

        toggleConfirmNewPassword.addEventListener('click', () => {
            const type = confirmNewPassword
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            confirmNewPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });
    </script>
</body>

</html>