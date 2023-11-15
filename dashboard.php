  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Registered Students</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

  <body>
      <?php
        include 'menu.php';
        ?>
      <div class="table-responsive">
          <table class="table">
              <thead class="thead-dark">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Image</th>
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
                      <th scope="col">User Type</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody id='registered_students'>

              </tbody>
          </table>
      </div>

      <script type="text/javascript" src="jquery.js"></script>
      <script type="text/javascript">
          var email = '<?php echo $_SESSION['email']; ?>';
          $(document).ready(function() {
              function loadData() {
                  $.ajax({
                      url: 'load-rs.php',
                      type: 'POST',
                      data: {
                          id: email
                      },
                      success: function(data) {
                          console.log(data)
                          $("#registered_students").html(data)
                      }
                  });
              }
              loadData();
          })

          function checkdelete() {
              return confirm(`Do you really want to delete?`)
          }
      </script>
  </body>

  </html>