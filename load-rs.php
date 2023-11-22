<?php
session_start();
include 'connect.php';

$sessionUser = $_SESSION['user_type'];
$sessionId = $_SESSION['id'];
$gallery_imagesArr = [];

if ($sessionUser && $_POST['type'] == "search") {
    $searchedTerm = $_POST['id'];
    $sql = "SELECT * FROM registration  WHERE firstname LIKE '%$searchedTerm%' OR phone LIKE '%$searchedTerm%'";
    $stmt = $pdo->prepare($sql);
    $res11 = $stmt->execute();
    $str = "";
    $rowNum = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $gallery_imagesArr = explode(',', $row['gallery_images']);
        $rowNum++;
        $trSingle = "
        <tr>
            <th scope='row'>{$rowNum}</th>       
            <td>
                <img src='{$row['std_img']}' alt='Profile image'  width='80' height='80' style='border-radius: 50%;'>
            </td>
            <td class='d-flex flex-wrap gallery-area'>";
        if (count($gallery_imagesArr)) {
            foreach ($gallery_imagesArr as $x => $singleImage) {
                $trSingle .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' class='single-image'>";
            }
        };
        $trSingle .= "
            </td>
            <td>{$row['firstname']}</td>
            <td>{$row['middlename']}</td>
            <td>{$row['lastname']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['class']}</td>
            <td>{$row['gender']}</td>
            <td>";
        $sql1 = "SELECT name from division_tb where id=:id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute(['id' => $row['division']]);
        $divisionRes = $stmt1->fetch(PDO::FETCH_ASSOC);
        $trSingle .=  $divisionRes['name'];
        $trSingle .= "</td>
    
            <td>";
        $sql2 = "SELECT name from district_tb where id=:id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute(['id' => $row['district']]);
        $districtRes = $stmt2->fetch(PDO::FETCH_ASSOC);
        $trSingle .=  $districtRes['name'];
        $trSingle .= "</td>    
    
            <td>";
        $sql3 = "SELECT name from upazila_tb where id=:id";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute(['id' => $row['upazila']]);
        $upazilaRes = $stmt3->fetch(PDO::FETCH_ASSOC);
        $trSingle .=  $upazilaRes['name'];
        $trSingle .= "</td>
            <td>{$row['address']}</td>
            <td>{$row['email']}</td>
            <td>{$row['password']}</td>
            <td>";
        if ($row['user_type'] == 1) {
            $trSingle .= 'Admin';
        } else if ($row['user_type'] == 0) {
            $trSingle .= 'Student';
        }
        $trSingle .=  "</td>
            <td>
                <a href='update-registered-students.php?id={$row['id']}&search={$searchedTerm}'>
                 <button class='btn btn-warning mb-2'>Update </button>
                </a>
                 <a href='delete.php?id={$row['id']}'>
                 <button class='btn btn-danger' onclick='return checkdelete()'>Delete </button>
                </a>
            </td>    
        </tr>
        ";
        $str .= $trSingle;
    }
    echo $str;
} else if ($sessionUser  && $_POST['type'] == "") {
    $sql = "SELECT * FROM registration";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $str = "";
    $rowNum = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $gallery_imagesArr = explode(',', $row['gallery_images']);
        $rowNum++;
        $trSingle = "
    <tr>
        <th scope='row'>{$rowNum}</th>       
        <td>
            <img src='{$row['std_img']}' alt='Profile image'  width='80' height='80' style='border-radius: 50%;'>
        </td>
        <td class='d-flex flex-wrap gallery-area'>";
        if (count($gallery_imagesArr)) {
            foreach ($gallery_imagesArr as $x => $singleImage) {
                $trSingle .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images' width='40' height='40' class='single-image'>";
            }
        }
        $trSingle .= "
        </td>
        <td>{$row['firstname']}</td>
        <td>{$row['middlename']}</td>
        <td>{$row['lastname']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['class']}</td>
        <td>{$row['gender']}</td>

        <td>";
        $sql1 = "SELECT name from division_tb where id=:id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute(['id' => $row['division']]);
        $divisionRes = $stmt1->fetch(PDO::FETCH_ASSOC);
        $trSingle .=  $divisionRes['name'];
        $trSingle .= "</td>

        <td>";
        $sql2 = "SELECT name from district_tb where id=:id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute(['id' => $row['district']]);
        $districtRes = $stmt2->fetch(PDO::FETCH_ASSOC);
        $trSingle .=  $districtRes['name'];
        $trSingle .= "</td>

        <td>";
        $sql3 = "SELECT name from upazila_tb where id=:id";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute(['id' => $row['upazila']]);
        $upazilaRes = $stmt3->fetch(PDO::FETCH_ASSOC);
        $trSingle .=  $upazilaRes['name'];
        $trSingle .= "</td>

        <td>{$row['address']}</td>
        <td>{$row['email']}</td>
        <td>{$row['password']}</td>
        <td>";
        if ($row['user_type'] == 1) {
            $trSingle .= 'Admin';
        } else if ($row['user_type'] == 0) {
            $trSingle .= 'Student';
        }
        $trSingle .=  "</td>
        <td>
             <button type='button' class='btn btn-warning mt-1 me-2 edit-btn' data-bs-toggle='modal' data-bs-target='#editUserModal'  data-eid='{$row["id"]}'> Update
              </button>
             <a href='delete.php?id={$row['id']}'>
             <button class='btn btn-danger' onclick='return checkdelete()'>Delete </button>
            </a>
        </td>    
    </tr>
    ";
        $str .= $trSingle;
    }
    echo $str;
} else {
    $sql = "SELECT * FROM registration WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $sessionId]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $rowNum = 1;
    $str = "
    <tr>
        <th scope='row'>{$rowNum}</th>       
        <td>
            <img src='{$res['std_img']}' alt='Profile image' width='80' height='80' style='border-radius: 50%;'>
        </td>
        <td class='d-flex flex-wrap gallery-area'>";
    $gallery_imagesArr = explode(',', $res['gallery_images']);
    if (count($gallery_imagesArr)) {
        foreach ($gallery_imagesArr as $x => $singleImage) {
            $str .= "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' class='single-image'>";
        }
    }
    $str .= "
        </td>
        <td>{$res['firstname']}</td>
        <td>{$res['middlename']}</td>
        <td>{$res['lastname']}</td>
        <td>{$res['phone']}</td>
        <td>{$res['class']}</td>
        <td>{$res['gender']}</td>
        <td>";
    $sql1 = "SELECT name from division_tb where id=:id";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(['id' => $res['division']]);
    $divisionRes = $stmt1->fetch(PDO::FETCH_ASSOC);
    $str .=  $divisionRes['name'];
    $str .= "</td>
    
            <td>";
    $sql2 = "SELECT name from district_tb where id=:id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(['id' => $res['district']]);
    $districtRes = $stmt2->fetch(PDO::FETCH_ASSOC);
    $str .=  $districtRes['name'];
    $str .= "</td>   
    
            <td>";
    $sql3 = "SELECT name from upazila_tb where id=:id";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute(['id' => $res['upazila']]);
    $upazilaRes = $stmt3->fetch(PDO::FETCH_ASSOC);
    $str .=  $upazilaRes['name'];
    $str .= "</td>
        <td>{$res['address']}</td>
        <td>{$res['email']}</td>
        <td>{$res['password']}</td>
        <td>
            <a href='update-registered-students.php?id={$res['id']}'>
             <button class='btn btn-warning mb-2'>Update </button>
            </a>
             <a href='delete.php?id={$res['id']}'>
             <button class='btn btn-danger' onclick='return checkdelete()'>Delete </button>
            </a>
        </td>    
    </tr>
    ";
    echo $str;
}



if ($_POST['type'] == "classData") {
    $sql = "SELECT * FROM class_tb";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else if ($_POST['type'] == "divisionData") {
    $sql = "SELECT * FROM division_tb";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else if ($_POST['type'] == "districtData") {
    $sql = "SELECT * FROM district_tb WHERE division_id = {$_POST['id']}";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
} else if ($_POST['type'] == "upazilaData") {
    $sql = "SELECT * FROM upazila_tb WHERE district_id = {$_POST['id']}";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $str = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}
echo $str;

if($sessionUser && $_POST['type'] == "edit"){
 $sql = "SELECT * FROM registration";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $str = "";
    $rowNum = 0;
    $trSingle = "
    <div class='form-section'>
                        <form action='dashboard.php' method='POST' enctype="multipart/form-data">
                            <div class='left'>
                                <!-- firstname  -->
                                <div class="mb-2 me-2">
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter First Name" required>
                                </div>

                                <!-- middlename  -->
                                <div class="mb-2 me-2">
                                    <input type="text" class="form-control" id="middlename" name="middlename"
                                        placeholder="Enter Middle Name">
                                </div>

                                <!-- lastname  -->
                                <div class="mb-2 me-2">
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Enter Last Name" required>
                                </div>
                                <!-- email -->
                                <div class="mb-2  me-2">
                                    <input type="email" class="form-control" id="email" name="email" required
                                        placeholder="Enter Email" required>
                                </div>
                                <!-- password -->
                                <div class="mb-2  me-2">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter Password" required>
                                </div>

                                <!-- re type password -->
                                <div class="mb-2 me-2">
                                    <input type="password" class="form-control" id="retypepassword"
                                        name="retypepassword" required placeholder="Re Enter Password">
                                </div>
                                <!-- phone  -->
                                <div class="mb-2 me-2">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter Phone Number" required>
                                </div>

                                <!-- image  -->
                                <div class="mb-4 me-2">
                                    <label for="image" class="form-label name">Profile Picture: </label>
                                    <input type="file" name="uploadfile" id="" class="ms-0">
                                </div>
                                <!-- gallery images  -->
                                <div class="mb-2 me-2">
                                    <label for="gallery-images" class="form-label name">Gallery Images: </label>
                                    <input type="file" name="files[]" multiple>
                                    <div class="d-flex">
                                        <?php
                            $gallery_imagesArr = [];
                            $gallery_imagesArr = explode(',', $result['gallery_images']);
                            if (count($gallery_imagesArr)) {
                                foreach ($gallery_imagesArr as $x => $singleImage) {
                                    echo "<img src='photo_gallery/{$singleImage}' alt='gallery_images'  width='40' height='40' style='border-radius: 50%;'>";
                                }
                            }
                            ?>
</div>
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
        <textarea class="form-control me-2" id="address" name="address" rows="4" cols="50"
            placeholder="Enter Address"></textarea>
    </div>
    <!-- register button  -->
    <button type="submit" class="btn btn-primary">Update User</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>
</form>
</div>
";

// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
// $gallery_imagesArr = explode(',', $row['gallery_images']);
// $rowNum++;
// // $trSingle = "
// }

echo $str;
}