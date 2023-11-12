<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>

<body>
    <h1>Update profile</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload: <br>
        <input type="file" name="fileToUpload" id="fileToUpload"> <br>
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>

</html>