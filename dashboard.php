    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        die();
    }

    echo "Welcome " . $_SESSION['email']
    ?>

    <a href="logout.php">Logout</a>