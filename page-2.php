<?php
    //start the session
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Survey. Page 2. Project 1 Ovcharenko</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      <?php
      //if session page-1 is set
      if (isset($_SESSION['page-1'])) {
          if (!isset($_SESSION['howPurchased'])) {
              //load empty form
              form("", "");
          } else {
              //load session variables to form
              form($_SESSION['howPurchased'], $_SESSION['purchases']);
          }
          // assign null to session variable 'page-1' so the post request can be sent
          $_SESSION['page-1'] = null;
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          //if post request sent
          //validation
          $error_msg = validate_fields();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //pass post variables to form
              form($_POST['howPurchased'], $_POST['purchases']);
          } else {
              //assign page-2 to session so you can't access page-3 directly
              $_SESSION['page-2'] = $_POST['page-2'];
              //move to page-3
              header('Location: page-3.php');
          }
        }
        else {
            //go back to index if try to go directly to this page
            header('Location: index.php');
      }
    ?>

      <?php
      //function to display validation errors
        function display_error($error_msg){
          echo '<div class="error-msg">';
          foreach($error_msg as $v){
              echo $v . '<br>';
          }
          echo '</div>';
      } ?>

      <?php
        //pass variables as arguments to function for validation
        function form($howPurchased, $purchases){ ?>
          <form class="form" method="POST" action="page-2.php">
              <h3>How did you complete your purchase?</h3>
              <!-- echo 'checked' if meet condition -->
              <input type="radio" id="online" name="howPurchased" <?php if ($howPurchased=="Online") echo "checked";?> value="Online"> <label for="online">Online</label>
              <input type="radio" id="byphone" name="howPurchased" <?php if ($howPurchased=="By phone") echo "checked";?> value="By phone"> <label for="byphone">By phone</label>
              <input type="radio" id="mobileapp" name="howPurchased" <?php if ($howPurchased=="Mobile App") echo "checked";?> value="Mobile App"> <label for="mobileapp">Mobile App</label>
              <input type="radio" id="instore" name="howPurchased" <?php if ($howPurchased=="In store") echo "checked";?> value="In store"> <label for="instore">In store</label>
              <br>
              <h3>Which of the following did you purchase?</h3>
              <!-- echo 'checked' if meet condition -->
              <input type="checkbox" id="phone" name="purchases[]" <?php if ((isset($_SESSION['purchases']) || isset($_POST['purchases'])) && (in_array("Phone", $purchases))) echo "checked";?> value="Phone"> <label for="phone">Phone</label>
              <input type="checkbox" id="smartv" name="purchases[]" <?php if ((isset($_SESSION['purchases']) || isset($_POST['purchases'])) && (in_array("Smart TV", $purchases))) echo "checked";?> value="Smart TV"> <label for="smartv">Smart TV</label>
              <input type="checkbox" id="laptop" name="purchases[]" <?php if ((isset($_SESSION['purchases']) || isset($_POST['purchases'])) && (in_array("Laptop", $purchases))) echo "checked";?> value="Laptop"> <label for="laptop">Laptop</label>
              <input type="checkbox" id="tablet" name="purchases[]" <?php if ((isset($_SESSION['purchases']) || isset($_POST['purchases'])) && (in_array("Tablet", $purchases))) echo "checked";?> value="Tablet"> <label for="tablet">Tablet</label>
              <input type="checkbox" id="hometheater" name="purchases[]" <?php if ((isset($_SESSION['purchases']) || isset($_POST['purchases'])) && (in_array("Home Theater", $purchases))) echo "checked";?> value="Home Theater"> <label for="hometheater">Home Theater</label>
              <br>
              <input class="btn" type="submit" name="page-2" value="Next">
          </form>
      <?php } ?>

      <?php
      //validation
      function validate_fields(){
          $error_msg = array();
          if (!isset($_POST['howPurchased'])){
              $error_msg[] = "One checkbox must be selected";
              //add empty value
              $_POST['howPurchased'] = '';
          } else if (isset($_POST['howPurchased'])) {
              $howPurchased = $_POST['howPurchased'];
          }
          if (!isset($_POST['purchases'])){
              $error_msg[] = "At least one purchase option must be selected";
              //add empty value
              $_POST['purchases'] = [];
          } else if (isset($_POST['purchases'])) {
              $purchases = $_POST['purchases'];
          }
          if (count($error_msg) == 0){
              //pass variables to session if no errors
              $_SESSION['howPurchased'] = $howPurchased;
              $_SESSION['purchases'] = $purchases;
          }
          return $error_msg;
      } ?>
  </body>
</html>