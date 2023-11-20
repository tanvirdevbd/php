<?php
session_start();
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
                <button type="submit" class='p-2 mb-1 btn btn-primary'>Search</button>
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

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type = "", category_id = '') {
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
                        $("#registered_students").html(data)

                    }
                });
            }
            loadData();

            $("#search-form").on('submit', function(e) {
                e.preventDefault();
                console.log('search found first search');
                var searchInfo = $("#search-info").val();
                if (searchInfo != "") {
                    loadData("search", searchInfo);
                }
            })
        })

        function checkdelete() {
            return confirm(`Do you really want to delete?`)
        }
    </script>
</body>

</html>