<?php
session_start();
$sessionEmail = $_SESSION['email'];
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex align-items-center text-white">
        <a class="navbar-brand" href="http://localhost/student-form/dashboard.php">Student Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active mt-2">
                    <a class="nav-link" href="http://localhost/student-form/profile.php">Profile</a>
                </li>
                <li class="nav-item mt-3 mx-3">
                    <?php
                    echo "<p>" . $_SESSION['email'] . "</p>";
                    ?>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link disabled" href="#">
                        <a href="logout.php">
                            <button class="btn btn-primary">Logout </button>
                        </a>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>