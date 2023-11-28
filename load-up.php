<?php
session_start();
include 'connect.php';

$sessionUser = $_SESSION['user_type'];
$sessionId = $_SESSION['id'];
$gallery_imagesArr = [];

if ($_POST['type'] == "edit") {
    $sql = "SELECT * FROM registration WHERE id={$_POST['id']}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $gallery_imagesArr = explode(',', $result['gallery_images']);

    //TODO: send form as html not as string

    $str = "
    <div class='form-section'>
    <form id='edit-form' method='post' enctype='multipart/form-data'>
                <div class='left'>
                    <!-- firstname  -->
                    <div class='mb-2 me-2'>
                        <input type='text' class='form-control' id='firstname' name='firstname' placeholder='Enter First Name' value='{$result['firstname']}'>
                        <input hidden type='text' class='form-control' id='user_own_id' name='user_own_id' value='{$_POST['id']}'>
                    </div>
                    <!-- middlename  -->
                    <div class='mb-2 me-2'>
                        <input type='text' class='form-control' id='middlename' name='middlename' placeholder='Enter Middle Name' value='{$result['middlename']} '>
                    </div>
                    <!-- lastname  -->
                    <div class='mb-2 me-2'>
                        <input type='text' class='form-control' id='lastname' name='lastname' placeholder='Enter Middle Name' value='{$result['lastname']} '>
                    </div>
                    <!-- email -->
                    <div class='mb-2 me-2'>
                        <input type='email' class='form-control' id='email' name='email' required placeholder='Enter Email' value='{$result['email']}'>
                    </div>
                    <!-- password -->
                    <div class='mb-2 me-2'>
                        <input type='password' class='form-control' id='password' name='password' placeholder='Enter Password' required value='{$result['password']}'>
                    </div>

                    <!-- re type password -->
                    <div class='mb-2 me-2'>
                        <input type='password' class='form-control' id='retypepassword' name='retypepassword' required placeholder='Re Enter Password' value='{$result['retypepassword']}'>
                    </div>

                    <!-- phone  -->
                    <div class='mb-2 me-2'>
                        <input type='text' class='form-control' id='phone' name='phone' placeholder='Enter Phone Number' value='{$result['phone']}'>
                    </div>
                    <!-- image  -->
                    <div class='mb-2 me-2'>
                        <label for='image' class='form-label name'>Profile Picture: </label>
                        <input type='file' name='uploadfile' id=''>
                        <img class='ms-0' src='{$result['std_img']}' alt='profile_image' width='40' height='40' style='border-radius: 50%;'>
                    </div>

                    <!-- gallery images  -->
                    <div class='mb-2 me-2'>
                        <label for='gallery-images' class='form-label name'>Gallery Images: </label>
                        <input type='file' name='files[]' multiple>
                        <div class='d-flex'>";
    if (count($gallery_imagesArr)) {
        foreach ($gallery_imagesArr as $x => $singleImage) {
            $str .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' class='single-image'>";
        }
    };
    $str .= "
                        </div>
                        </div> 
                        </div> 

                        <div class='right'>
                        <!-- gender  -->
                        <div class='mb-2'>
                            <label for='gender' class='form-label me-3 name'>Gender: </label>
                            <input type='radio' id='male' name='gender' value='MALE'";
    if ($result['gender'] == 'MALE') {
        $str .= "checked";
    } else {
        $str .= "";
    }
    $str .= ">
                            <label for='html' class='mx-1'>Male</label>
                            <input type='radio' id='female' name='gender' value='FEMALE'";
    if ($result['gender'] == 'FEMALE') {
        $str .= "checked";
    } else {
        $str .= "";
    }
    $str .= ">
                            <label for='html' class='mx-1'>Female</label>
                            <input type='radio' id='others' name='gender' value='OTHERS'";
    if ($result['gender'] == 'OTHERS') {
        $str .= "checked";
    } else {
        $str .= "";
    }
    $str .= ">
                            <label for='html' class='mx-1'>Others</label>
                        </div>




                        <!-- user  -->";
    if ($sessionUser) {
        $str .=
            "<div class='mb-2'>
                                <label for='user_type' class='form-label me-4 name'>User: </label>
                                <select name='user_type' id='user_type' class='select-area'>
                                    <option value='1'";
        if ($result['user_type'] == 1) {
            $str .= "selected";
        } else {
            $str .= "";
        }
        $str .= ">Admin
                                    </option>
                                    <option value='0'";
        if ($result['user_type'] == 0) {
            $str .= "selected";
        } else {
            $str .= "";
        }
        $str .= ">Student
                                    </option>
                                </select>
                            </div>";
    }

    $str .= "
    <!-- class  -->
    <div class='mb-2'>
        <label for='class' class='form-label me-4 name'>Class: </label>
        <select name='class' id='class' class='select-area'>";
    $sql = "SELECT * FROM class_tb";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'";
        if ($result['class'] == $row['id']) {
            $str .= "selected";
        } else {
            $str .= "";
        }
        $str .= ">
                    {$row['name']}
                </option>     ";
    }
    $str .= "
        </select>
    </div> 
    <!-- division  -->
    <div class='mb-2'>
        <label for='division' class='form-label me-2 name'>Division: </label>
        <select name='division' id='division' class='select-area'>
        </select>
    </div>

    <!-- district  -->
    <div class='mb-2'>
        <label for='district' class='form-label me-3  name'>District: </label>
        <select name='district' id='district' class='select-area'>";
    $sql = "SELECT * FROM district_tb";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'";
        if ($result['district'] == $row['id']) {
            $str .= "selected";
        } else {
            $str .= "";
        }
        $str .= ">
                                {$row['name']}
                            </option>     ";
    }
    $str .= "
            </select>
        </div>

        <!-- upazila  -->
                    <div class='mb-2'>
                        <label for='upazila' class='form-label me-3 name'>Upazila: </label>
                        <select name='upazila' id='upazila' class='select-area'>";
    $sql = "SELECT * FROM upazila_tb";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'";
        if ($result['upazila'] == $row['id']) {
            $str .= "selected";
        } else {
            $str .= "";
        }
        $str .= ">
                                                    {$row['name']}
                                                </option>     ";
    }
    $str .= "
                                </select>
                            </div>

                            <!-- address  -->
                            <div class='mb-2'>
                                <textarea class='form-control me-2' id='address' name='address' rows='4' cols='50'>{$result['address']}</textarea>
                            </div>
                            <!-- edit button  -->
                            <button type='submit' class='btn btn-primary w-100' data-bs-dismiss='modal'>Update </button>
                    </div>
                    </form>
             </div>
        ";
    echo $str;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type = "", category_id = "") {
                $.ajax({
                    url: 'load-rs.php',
                    type: 'POST',
                    data: {
                        type: type,
                        id: category_id
                    },
                    success: function(data) {
                        $("#registered_students").html(data);
                    }
                });
            }

            function loadLocationData(type = "", category_id = "") {
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
            loadLocationData();

            $("#division").on("change", function() {
                var division = $("#division").val();
                if (division != "") {
                    loadLocationData("districtData", division);
                } else {
                    $("#district").html("");
                }
            })

            $("#district").on("change", function() {
                var district = $("#district").val();
                if (district != "") {
                    loadLocationData("upazilaData", district);
                } else {
                    $("#upazila").html("");
                }
            })

            $("form#edit-form").on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'ajax-update.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        let message = JSON.parse(data);
                        if (message.successMessage) {
                            $("#success-modal").html(message.successMessage).show();
                            setTimeout(function() {
                                $("#success-modal").hide();
                            }, 3000);
                            $("#error-modal").hide();
                            loadData();
                        } else {
                            $("#error-modal").html(message.errorMessage).show().slideDown();
                            setTimeout(function() {
                                $("#error-modal").hide().slideUp();
                            }, 3000);
                            $("#success-modal").hide().slideUp();
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            })
        })
    </script>
</body>

</html>