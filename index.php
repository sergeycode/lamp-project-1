<?php
    //start the session
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Project 1 Ovcharenko</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      <?php
          //if button begin is set
          if (isset($_POST['begin'])) {
              //assign begin to session
              $_SESSION['begin'] = $_POST['begin'];
              //move to page-1
              header('Location: page-1.php');
          }
      ?>
    <form class="form" method="POST" action="index.php">
        <h1 class="heading">Customer satisfaction survey</h1>
        <div class="block-center">
            <p>
                Hi! Welcome to the customer satisfaction survey. <br>
                Please, answer some questions based on your recent purchase. <br>
                After clicking BEGIN button, the survey will be started.
            </p>
            <button class="btn" type="submit" name="begin">Begin</button>
        </div>
      </form>
  </body>
</html>
