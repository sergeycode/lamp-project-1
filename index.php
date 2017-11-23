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
          //if session fullName is not set
          if (!isset($_SESSION['fullName'])) {
              //load empty form
              form_1("", "", "");
          } else {
              //load session variables to form
              form_1($_SESSION['fullName'], $_SESSION['age'], $_SESSION['student']);
          }
      } else if (isset($_SESSION['page']) && ($_SESSION['page'] == 1)){
          //validation
          $error_msg = validate_form_1();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //pass post variables to form
              form_1($_POST['fullName'], $_POST['age'], $_POST['student']);
          } else {
              $_SESSION['page'] = 2;
              if (!isset($_SESSION['howPurchased'])) {
                  form_2("", "");
              } else {
                  form_2($_SESSION['howPurchased'], $_SESSION['purchases']);
              }
          }
      } else if (isset($_SESSION['page']) && ($_SESSION['page'] == 2)){
          $error_msg = validate_form_2();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //pass post variables to form
              form_2($_POST['howPurchased'], $_POST['purchases']);
          } else {
              $_SESSION['page'] = 3;
              if (!isset($_SESSION['satisfaction' . $purchase])) {
                  //load empty form
                  form_3("", "");
              } else {
                  //load session variables to form
                  form_3($_SESSION['satisfaction' . $purchase], $_SESSION['recommend' . $purchase]);
              }
          }
      } else if (isset($_SESSION['page']) && ($_SESSION['page'] == 3)){
          $error_msg = validate_form_3();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //pass post variables to form
              form_3($_POST['satisfaction' . $purchase], $_POST['recommend' . $purchase]);
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
