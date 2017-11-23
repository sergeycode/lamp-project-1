<?php
    //start the session
    session_start();

//    if (!isset($_SESSION['page'])) {
//        $_SESSION['page'] = "intro";
//    }

    //separated php files with forms, validations, and displaying errors
    require_once("./includes/intro.php");
    require_once("./includes/page-1.php");
    require_once("./includes/page-2.php");
    require_once("./includes/page-3.php");
    require_once("./includes/thank-you.php");
    require_once("./includes/displayErrors.php");
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
  <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      if (isset($_SESSION['page']) && ($_SESSION['page'] == 0)) {
          $_SESSION['page'] = 1;
          //load form 1
          form_1();
      } else if (isset($_SESSION['page']) && ($_SESSION['page'] == 1)){
          //validation
          $error_msg = validate_form_1();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //load form 1
              form_1();
          } else {
              $_SESSION['page'] = 2;
              //load form 2
              form_2();
          }
      } else if (isset($_SESSION['page']) && ($_SESSION['page'] == 2)){
          $error_msg = validate_form_2();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //load form 2
              form_2();
          } else {
              $_SESSION['page'] = 3;
              //load form 3
              form_3();
          }
      } else if (isset($_SESSION['page']) && ($_SESSION['page'] == 3)){
          $error_msg = validate_form_3();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //load form 3
              form_3();
          } else {
              thankyou();
          }
      }
  } else {
      $_SESSION['page'] = 0;
      intro();
  } ?>

  </body>
</html>
