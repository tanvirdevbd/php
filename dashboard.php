<?php
session_start();
if (!$_SESSION["id"]) {
    header("Location: login.php");
}

include 'connect.php';

$searchedTerm = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $searchedTerm = $_GET['search-info'];
    $sql = "SELECT * FROM registration  WHERE firstname LIKE '%$searchedTerm%' OR phone LIKE '%$searchedTerm%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
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
    if ($_SESSION['user_type'] == 1) {
    ?>
        <div class="d-flex justify-content-end">
            <form action='dashboard.php' method='GET' id="search-form">
                <input type="text" placeholder="Name or phone by Search" class="my-2 p-2 search-dashboard" id="search-info" name="search-info">
                <button type="submit" class='p-2 btn btn-primary'>Search</button>
            </form>
        </div>
    <?php
    }
    ?>
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
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
                    // $sessionId = $_SESSION['id'];
                    // $sql1 = "SELECT * FROM registration WHERE id=:id";
                    // $stmt1 = $pdo->prepare($sql1);
                    // $stmt1->execute(['id' => $sessionId]);
                    // $userRes = $stmt1->fetch(PDO::FETCH_ASSOC);
                    // if ($userRes['user_type'] == 1) {
                    //     echo '<th scope="col">User Type</th>';
                    // }
                    ?>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id='registered_students'>
                <?php
                echo "<pre>";
                print_r($sql);
                echo "</pre>";
                die;
                $gallery_imagesArr = [];
                $rowNum = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $gallery_imagesArr = explode(',', $row['gallery_images']);
                ?>
                    <tr>
                        <th scope='row'>{$rowNum}</th>
                        <td>
                            <img src="<?php echo $row[' std_img'] ?>" alt='Profile image' width='80' height='80' style='border-radius: 50%;'>
                        </td>
                        <td class='d-flex'>
                            <?php
                            if (count($gallery_imagesArr)) {
                                foreach ($gallery_imagesArr as $x => $singleImage) {
                            ?>
                                    <img src='photo_gallery/<?php echo $singleImage ?>' alt='gallery_images' width='40' height='40' style='border-radius: 50%;'>;
                            <?php
                                }
                            }
                            ?>
                        </td>
                        <td><?php echo $row['firstname'] ?></td>
                        <td><?php echo $row['middlename'] ?></td>
                        <td><?php echo $row['lastname'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['class'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td>
                            <?php
                            $sql1 = "SELECT name from division_tb where id=:id";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute(['id' => $row['division']]);
                            $divisionRes = $stmt1->fetch(PDO::FETCH_ASSOC);
                            echo $divisionRes['name'];
                            ?>
                        </td>

                        <td>
                            <?php
                            $sql2 = "SELECT name from district_tb where id=:id";
                            $stmt2 = $pdo->prepare($sql2);
                            $stmt2->execute(['id' => $row['district']]);
                            $districtRes = $stmt2->fetch(PDO::FETCH_ASSOC);
                            echo $districtRes['name'];
                            ?>
                        </td>
                        <td>
                            <?php
                            $sql3 = "SELECT name from upazila_tb where id=:id";
                            $stmt3 = $pdo->prepare($sql3);
                            $stmt3->execute(['id' => $row['upazila']]);
                            $upazilaRes = $stmt3->fetch(PDO::FETCH_ASSOC);
                            echo $upazilaRes['name'];
                            ?>
                        </td>
                        <td><?php echo $row['address'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td>
                            <?php
                            if ($row['user_type'] == 1) {
                                echo 'Admin';
                            } else if ($row['user_type'] == 0) {
                                echo  'Student';
                            }
                            ?>
                        </td>
                        <td>
                            <a href='update-registered-students.php?id=<?php echo $row[' id'] ?>'>
                                <button class='btn btn-warning mb-2'>Update </button>
                            </a>
                            <a href='delete.php?id= <?php echo $row[' id'] ?>'>
                                <button class='btn btn-danger' onclick='return checkdelete()'>Delete </button>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        if ("<?php echo $searchedTerm ?>" == '') {
            console.log('no search')
            $(document).ready(function() {
                function loadData(type = "", category_id) {
                    $.ajax({
                        url: 'load-rs.php',
                        type: 'POST',
                        data: {
                            type: type,
                            id: category_id
                        },
                        success: function(data) {
                            console.log(data)
                            $("#registered_students").html(data)
                        }
                    });
                }
                loadData();

                // $("#search-form").on('submit', function(e) {
                //     e.preventDefault();
                //     var searchInfo = $("#search-info").val();
                //     if (searchInfo != "") {
                //         loadData("search", searchInfo);
                //     } else {
                //         loadData("", searchInfo);
                //     }
                // })
            })

            function checkdelete() {
                return confirm(`Do you really want to delete?`)
            }
        } else {
            console.log('searched now ')
        }
    </script>
</body>

</html>