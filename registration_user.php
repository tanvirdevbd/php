<?php
include 'connect.php';

$success = 0;
$error = 0;
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $typeOfRegistration = $_POST['typeOfRegistration'];
    $refRegistrationID = $_POST['refRegistrationID'];
    $sql = "SELECT typeOfRegistration FROM `registration_pricing` WHERE refRegistrationID=$refRegistrationID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $existTypeOfRegistration = $stmt->fetch(PDO::FETCH_ASSOC);
    // TODO: loop will be here 
// echo "<pre>";
// print_r($existTypeOfRegistration['typeOfRegistration']);
// print_r($typeOfRegistration);
// echo "</pre>";
// die;

    if ($existTypeOfRegistration['typeOfRegistration'] == $typeOfRegistration) {

        $errorMessage = "Type of registration duplicate from same user";
    } else {
            $referenceType = $_POST['referenceType'];
    $referrerRegistrationCategoryID = $_POST['referrerRegistrationCategoryID'];
        $registratonAmount = $_POST['registratonAmount'];
        $distributionCode = $_POST['distributionCode'];
        $referenceCode = $_POST['referenceCode'];

        $sql = "INSERT INTO `registration_pricing`(typeOfRegistration, refRegistrationID, referenceType, referrerRegistrationCategoryID, registratonAmount, distributionCode, referenceCode) VALUES(:typeOfRegistration, :refRegistrationID, :referenceType, :referrerRegistrationCategoryID, :registratonAmount, :distributionCode, :referenceCode)";

        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute(['typeOfRegistration' => $typeOfRegistration, 'refRegistrationID' => $refRegistrationID, 'referenceType' => $referenceType, 'referrerRegistrationCategoryID' => $referrerRegistrationCategoryID, 'registratonAmount' => $registratonAmount,  'distributionCode' => $distributionCode,  'referenceCode' => $referenceCode]);

        if ($result) {
            $success = "Registration Successful";
        } else {
            $errorMessage = "Registration Failed";
        }
        }   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php
    if ($success) {
        echo "<div class='alert alert-success' role='alert'>" . $success . "</div>";
    } else if ($errorMessage) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }
    ?>

    <div class='container'>
        <div class='title'>
            <h1>User Registration</h1>
        </div>
        <div class='form-section'>
            <form action='registration_user.php' method='POST'>
                <div class="mb-2">
                    <label for="typeOfRegistration" class="form-label me-4 ">typeOfRegistration: </label>
                    <select name="typeOfRegistration" id="typeOfRegistration" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="refRegistrationID " class="form-label me-4 ">refRegistrationID : </label>
                    <input type="number" name="refRegistrationID" id="refRegistrationID">
                </div>
                <div class="mb-2">
                    <label for="referenceType" class="form-label me-4">referenceType : </label>
                    <select name="referenceType" id="referenceType" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="referrerRegistrationCategoryID" class="form-label me-4 ">referrerRegistrationCategoryID
                        : </label>
                    <input type="text" name="referrerRegistrationCategoryID" id="referrerRegistrationCategoryID">
                </div>
                <div class="mb-2">
                    <label for="registratonAmount" class="form-label me-4 ">registratonAmount : </label>
                    <input type="number" name="registratonAmount" id="registratonAmount">
                </div>
                <div class="mb-2">
                    <label for="distributionCode " class="form-label me-4 ">distributionCode : </label>
                    <input type="number" name="distributionCode" id="distributionCode">
                </div>
                <div class="mb-2">
                    <label for="referenceCode " class="form-label me-4 ">referenceCode : </label>
                    <input type="number" name="referenceCode" id="referenceCode">
                </div>
                <button type="submit" class="reg-btn">Register</button>
        </div>
    </div>
</body>

</html>