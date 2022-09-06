<!doctype html>

<?php

 session_start();

 $user = $_POST["user"];
 $db   = "cbdatabase";
 $host = "10.29.21.4";

 $dbuser = "root";
 $dbpass = "Forkbomb00";
 $database = "cbdatabase";
 $dbhost = "10.29.21.4";  

?>

<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Update Users</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
  </head>

  <?php
    mysqli_report(MYSQLI_REPORT_OFF); //Turn off irritating default messages

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $database);

    $query = "SELECT COUNT(USER_ID) AS TOTALCOUNT, FIRST_NAME, LAST_NAME, USER_ID, EMAIL, MAJOR, TYPE FROM UAFSBULK
                WHERE USER_ID = '" . $user . "' GROUP BY USER_ID;";
    $rs = $mysqli->query($query);

    if ($mysqli->error) {
        try {   
            throw new Exception("MySQL error $mysqli->error <br> Query:<br> $query", $msqli->errno);   
        } catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
        }
    }

  // Iterate through result set ---------------------------------------------------------
  if ( mysqli_num_rows($rs) > 0 ) {

    while ( $row2 = mysqli_fetch_assoc($rs) ) {
       $matching = $row2["TOTALCOUNT"];

       if ( $matching == 1 ) { 
           
         $fName   = $row2["FIRST_NAME"];
         $lName   = $row2["LAST_NAME"];
         $userID  = $row2["USER_ID"];
         $email   = substr($row2["EMAIL"], 0, -9);
         $major   = $row2["MAJOR"];
         $type    = $row2["TYPE"];

        ?>

        <script type="text/javascript">
          updater();
          function updater() {
            document.getElementById("user").value = '<?php echo $user ?>';
            document.getElementById("firstName").value = '<?php echo $fName ?>';
            document.getElementById("lastName").value = '<?php echo $lName ?>';
            document.getElementById("userID").value = '<?php echo $userID ?>';
            document.getElementById("password").value = '<?php echo $email ?>';
            document.getElementById("password_check").value = '<?php echo $email ?>';
            document.getElementById("email").value = '<?php echo $email ?>';
            document.getElementById("major").value = '<?php echo $major ?>';
            document.getElementById("type").value = '<?php echo $type ?>';
            document.getElementById("userNum").value = '<?php echo $user ?>';
          }
        </script>

        <?php
 
       } else { // Redirect
          header("Location: viewer.php"); 
          exit();
       }
    }
  } else {
    header("Location: viewer.php"); 
    echo "Problem";
  } 
  // -------------------------------------------------------------------------------------

  mysqli_close($con);

  ?>

  <body class="bg-light" onload="updater();">
    <div class="container">

      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="logo.png" alt="" width="72" height="72">
        <h2>Update Users</h2>
        <p class="lead">Students and Faculty currently enrolled at the Institution of Language, Fort Smith. </p>
      </div>

      <div style="height: 300px; overflow: scroll;">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>User ID</th>
              <th>Email</th>
              <th>Major</th>
              <th>Type</th>
            </tr>
          </thead>
          <tbody>

<?php //Iterate through the result set
  $sql = "SELECT * FROM UAFSBULK
          LIMIT 1000";

  //  Connect
  $con =  mysqli_connect($dbhost, $dbuser, $dbpass, $database);
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $rs = $stmt->get_result();

  if ( mysqli_num_rows($rs) > 0 ) {
    while ( $row = mysqli_fetch_assoc($rs) ) {
?>
            <tr>
              <td><?= $row["FIRST_NAME"]   ?></td>
              <td><?= $row["LAST_NAME"]    ?></td>
              <td><?= $row["USER_ID"]      ?></td>
              <td><?= $row["EMAIL"]        ?></td>
              <td><?= $row["MAJOR"]        ?></td>
              <td><?= $row["TYPE"]         ?></td>
            </tr>
<?php }
  } else {
    echo "That's not good";
  }
?>
          </tbody>
        </table>
      </div>

<?php // Close connection
  mysqli_close($con);


  if($_SESSION["type"] == "Professor") {
    //Only show the edit options if qualifications are met.
?>

      <br>

      <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Search User</h4>
          <hr class="mb-4">
          <script language='javascript' type="text/javascript">
            function submitForm(action) {
              if (Number.isInteger(document.getElementById('user').value)) {
                input.setCustomValidity('Must enter valid #.');
              } else {
                var form = document.getElementById('form1');
                form.action = action;
                form.submit();
              }
            }
          </script>

          <form id="form1" method="POST" novalidate>
            <label for="user">User ID</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="" id="user" name="user" aria-describedby="basic-addon2" required>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" onclick="submitForm('update.php')" type="button">Update</button>
                <button class="btn btn-outline-secondary" onclick="submitForm('delete.php')" type="button">Delete</button>
              </div>
              <div class="invalid-feedback">
                User # is required.
              </div>
            </div>
          </form>

          <br>

          <h4 class="mb-3">Update User</h4>
          <hr class="mb-4">
          <form class="needs-validation" action="updateUser.php" method="POST" novalidate>
            <!-- Name -------------------------------------------------------------------------------------->
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" name="FName" placeholder="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" name="LName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="userID">User ID</label>
                <input type="text" class="form-control" id="userID" name="userID" oninput="$('#email').attr('value', this.value)" required>
                <div class="invalid-feedback">
                  Valid User ID is required.
                </div>
              </div>
            </div>

            <!-- Password ---------------------------------------------------------------------------------->
            <div class="mb-3">
              <label for="username">Password</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  <div class="invalid-feedback" style="width: 100%;">
                    Passwords must match.
                  </div>
                </div>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="password_check" placeholder="Confirm Password" oninput="check(this)" require>
                  <div class="invalid-feedback" style="width: 100%;">
                    Passwords must match.
                  </div>
                </div>
                <label class="col-md-6" style="font-size: 10px; color: green;">User password cannot be updated, please contact your system admin.</label>
                <script language='javascript' type='text/javascript'>
                  function check(input) {
                      if (input.value != document.getElementById('password').value) {
                          input.setCustomValidity('Password Must be Matching.');
                      } else {
                          // input is valid -- reset the error message
                          input.setCustomValidity('');
                      }
                  }
                </script>
              </div>
            </div>

            <!-- Email ------------------------------------------------------------------------------------->
            <div class="mb-3">
              <label for="username">Email</label>
              <div class="input-group">
                <input type="text" class="form-control" id="email" name="email" placeholder="id@g.uafs.edu" oninput="ValidateEmail(this)" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Valid email is required.
                </div>
                <script language='javascript' type='text/javascript'>
                  function ValidateEmail(input) {
                   if (input.value.includes('@')) {
                          input.setCustomValidity('Please check format.');
                      } else {
                          // input is valid -- reset the error message
                          input.setCustomValidity('');
                      }
                  }
                </script>
                <div class="input-group-prepend">
                  <span class="input-group-text">@tech.edu</span>
                </div>
              </div>
            </div>

            <!-- Major ------------------------------------------------------------------------------------>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Major</label>
                <select class="custom-select d-block w-100" id="major" name="major" required>
                  <option value="">Choose...</option>
                  <option>Computer Science</option>
                  <option>Engineering</option>
                  <option>Nursing</option>
                  <option>Math</option>
                  <option>Criminal Justice</option>
                  <option>Biology</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid major.
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label for="state">Type</label>
                <select class="custom-select d-block w-100" id="type" name="type" required>
                  <option value="">Choose...</option>
                  <option>Student</option>
                  <option>Professor</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid type.
                </div>
              </div>
            </div>

             <input type="hidden" id="userNum" name="userNum">
            
            <hr class="mb-4">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6 mb-3 text-center">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
              </div>
            </div>
          </form>

        </div>
      </div>


<?php
  }
?>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Clayton Bond</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="index.html">Sign Out</a></li>
          <li class="list-inline-item"><a href="viewer.php">View</a></li>
          <li class="list-inline-item"><a href="#">Back to Top</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
