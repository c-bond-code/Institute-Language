<!-- ********************************
Name: Clayton Bond
Username: cloud101
Problem Set: PS1
Due Date: 11 15, 2019
******************************** -->

<!doctype html>

<?php

$scriptName = "cd java && java WikipediaSearch quicksort";
exec('cd java && java WikipediaSearch quicksort', $text);
echo $text;

?>



<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>View Users</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
  </head>


  <body class="bg-light">

    <div class="container">

      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="logo.png" alt="" width="72" height="72">
        <h2>View Users</h2>
        <p class="lead">Students and Faculty currently enrolled at the Institution of Language, Fort Smith. </p>

        <?php
            //$lines = explode("\n", trim($text));
            $lines = $text;
            for ($i=0; $i < count($lines); $i++) { 
               ?>
                  <a href="https://<?= $lines[$i+1] ?>"> <h1><?= $lines[$i] ?></h1> </a>
               <?php
               $i++;
            }
        ?>

        <p>Done</p>

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
