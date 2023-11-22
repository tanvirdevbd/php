<?php
session_start();

$success = 0;
$error = 0;
$errorMessage = "";

if (!$_SESSION["id"]) {
    header("Location: login.php");
}

include 'connect.php';

$updateAfterSearchInfo = 0;
$updateAfterSearchValue = '';
if (isset($_GET['search'])) {
    $updateAfterSearchInfo = 1;
    $updateAfterSearchValue = $_GET['search'];
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $firstname = $_POST['firstname'];
//     $middlename = $_POST['middlename'];
//     $lastname = $_POST['lastname'];
//     $email = $_POST['email'];

//     $sql = "SELECT * FROM `registration` WHERE email='$email' ";

//     $stmt = $pdo->prepare($sql);

//     $stmt->execute();

//     $resEmail = $stmt->fetch(PDO::FETCH_ASSOC);

//     if (!$resEmail) {
//         $password = $_POST['password'];
//         $retypepassword = $_POST['retypepassword'];
//         $class = $_POST['class'];
//         $gender = $_POST['gender'];
//         $division = $_POST['division'];
//         $district = $_POST['district'];
//         $upazila = $_POST['upazila'];
//         $address = $_POST['address'];

//         $filename = $_FILES["uploadfile"]["name"];
//         $tempname = $_FILES["uploadfile"]["tmp_name"];
//         $folder = "images/" . $filename;
//         move_uploaded_file($tempname, $folder);
//         $std_img = $folder;

//         $phone = $_POST['phone'];
//         $pattern = "/^(?:\+?88)?01[3-9$]\d{8}/";
//         if (!preg_match($pattern, $phone)) {
//             $errorMessage = "Phone number is not valid BD number";
//         } else {
//             $sql = "INSERT INTO `registration`(std_img, firstname, middlename, lastname, phone, email, password, retypepassword, class, gender, division, district, upazila, address) VALUES(:std_img, :firstname, :middlename, :lastname, :phone, :email, :password, :retypepassword, :class, :gender, :division, :district, :upazila,  :address)";

//             $stmt = $pdo->prepare($sql);

//             $result = $stmt->execute(['std_img' => $std_img, 'firstname' => $firstname, 'middlename' => $middlename, 'lastname' => $lastname, 'phone' => $phone,  'email' => $email,  'password' => $password,  'retypepassword' => $retypepassword, 'class' => $class, 'gender' => $gender, 'division' => $division, 'district' => $district, 'upazila' => $upazila, 'address' => $address]);

//             if ($result) {
//                 $success = "User added Successfully";
//             } else {
//                 $errorMessage = "User not added";
//             }
//         }
//     } else {
//         $errorMessage = "Email already exists give a new email for complete registration";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <?php
    include 'menu.php';
    if ($success) {
        echo "<div class='alert alert-success' role='alert'>" . $success . "</div>";
        echo "<meta http-equiv='refresh' content='1;url=dashboard.php'>";
    } else if ($errorMessage) {
        echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
    }


    if ($_SESSION['user_type'] == 1) {
    ?>
        <div class="d-flex justify-content-end">
            <!-- edit Modal start-->
            <div class="modal modal-tall fade modal-xl" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Update User Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                    </div>
                </div>
            </div>
            <!-- edit Modal end-->

            <!-- add Modal start-->
            <button type="button" class="btn btn-primary mt-1 me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                Add New User
            </button>

            <div class="modal  modal-tall fade modal-xl" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">User Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class='form-section'>
                                <form action='dashboard.php' method='POST' enctype="multipart/form-data">
                                    <div class='left'>
                                        <!-- firstname  -->
                                        <div class="mb-2 me-2">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" required>
                                        </div>

                                        <!-- middlename  -->
                                        <div class="mb-2 me-2">
                                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middle Name">
                                        </div>

                                        <!-- lastname  -->
                                        <div class="mb-2 me-2">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" required>
                                        </div>
                                        <!-- email -->
                                        <div class="mb-2  me-2">
                                            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Email" required>
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
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                                        </div>

                                        <!-- image  -->
                                        <div class="mb-4 me-2">
                                            <label for="image" class="form-label name">Profile Picture: </label>
                                            <input type="file" name="uploadfile" id="" class="ms-0">
                                        </div>
                                    </div>
                                    <div class='right'>
                                        <!-- gender  -->
                                        <div class="mb-2">
                                            <label for="gender" class="form-label me-3 name">Gender: </label>
                                            <input type="radio" id="male" name="gender" value="MALE" required>
                                            <label for="html" class='mx-1'>Male</label>
                                            <input type="radio" id="female" name="gender" value="FEMALE" required>
                                            <label for="html" class='mx-1'>Female</label>
                                            <input type="radio" id="others" name="gender" value="OTHERS" required>
                                            <label for="html" class='mx-1'>Others</label>
                                        </div>
                                        <!-- class  -->
                                        <div class="mb-2">
                                            <label for="class" class="form-label me-4 name">Class: </label>
                                            <select name="class" id="class" class="select-area" required>
                                                <option value="">Select Class</option>
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
                                            <textarea class="form-control me-2" id="address" name="address" rows="4" cols="50" placeholder="Enter Address"></textarea>
                                        </div>
                                        <!-- register button  -->
                                        <button type="submit" class="btn btn-primary">Add User</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add Modal end-->
            <input type="text" id="search-info" name="search-info" class="my-2 p-2 me-3 search-dashboard" placeholder="Type name or phone to Search">
        </div>
    <?php
    }
    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Gallery images</th>
                    <th scope="col">First name</th>
                    <th scope="col">Middle name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Class</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Division</th>
                    <th scope="col">District</th>
                    <th scope="col">Upazila</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <?php
                    $sessionId = $_SESSION['id'];
                    $sql1 = "SELECT * FROM registration WHERE id=:id";
                    $stmt1 = $pdo->prepare($sql1);
                    $stmt1->execute(['id' => $sessionId]);
                    $userRes = $stmt1->fetch(PDO::FETCH_ASSOC);
                    if ($userRes['user_type'] == 1) {
                        echo '<th scope="col">User Type</th>';
                    }
                    ?>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id='registered_students'>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type = "", category_id = "") {
                if (<?php echo $updateAfterSearchInfo ?>) {
                    type = "search";
                    category_id = "<?php echo $updateAfterSearchValue ?>";
                }
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
            loadData();

            $("#search-info").on('keyup', function() {
                var searchInfo = $("#search-info").val();
                if (searchInfo != "") {
                    loadData("search", searchInfo);
                }
            })

            function loadLocationData(type, category_id) {
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

            $(document).on('click', '.edit-btn', function() {
                userId = $(this).data("eid");
                $.ajax({
                    url: 'load-up.php',
                    type: 'POST',
                    data: {
                        type: "edit",
                        id: userId
                    },
                    success: function(data) {
                        $(".modal-body").html(data)
                    }
                });
            })

            $(document).on('click', '.edit-submit-btn', function() {
                var firstname = $("#firstname").val();
                var middlename = $("#middlename").val();
                var lastname = $("#lastname").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var retypepassword = $("#retypepassword").val();
                var phone = $("#phone").val();
                var user_type = $("#user_type").val();
                var classNum = $("#class").val();
                var division = $("#division").val();
                var district = $("#district").val();
                var upazila = $("#upazila").val();
                console.log("upazila", upazila);

                // $.ajax({
                //     url: 'load-up.php',
                //     type: 'POST',
                //     data: {
                //         type: "edit-submit",
                //         id: userId
                //     },
                //     success: function(data) {
                //         console.log(data);
                //         // loadData();
                //     }
                // });
            })

            function loadClass() {
                $.ajax({
                    url: 'load-cs.php',
                    type: 'POST',
                    data: {
                        type: "classData"
                    },
                    success: function(data) {
                        $("#class").append(data)
                    }
                });
            }
            loadClass();
        })

        function checkdelete() {
            return confirm(`Do you really want to delete?`)
        }
    </script>
</body>

</html>