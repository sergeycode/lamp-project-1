<?php
    //start the session
    session_start();
    // assign session variable 'purchases' replacing all spaces in values
    $purchases = str_replace(' ', '', $_SESSION['purchases']);
    //for each purchase add to the variable name purchase name, for example 'satisfactionPhone' etc.
    foreach ($purchases as $purchase) {
        $satisfactionPost = 'satisfaction' . $purchase;
        $recommendPost = 'recommend' . $purchase;
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Survey. Page 3. Project 1 Ovcharenko</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      <?php
      //if session page-2 is set
      if (isset($_SESSION['page-2'])) {
          if (!isset($_SESSION[$satisfactionPost])) {
              //load empty form
              form("", "");
          } else {
              //load session variables to form
              form($_SESSION['satisfaction' . $purchase], $_SESSION['recommend' . $purchase]);
          }
          // assign null to session variable 'page-2' so the post request can be sent
          $_SESSION['page-2'] = null;
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          //if post request sent
          //validation
          $error_msg = validate_fields();
          if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //pass post variables to form
              form($_POST['satisfaction' . $purchase], $_POST['recommend' . $purchase]);
          } else {
              //assign page-3 to session so you can't access page-4 directly
              $_SESSION['page-3'] = $_POST['page-3'];
              //move to page-4
              header('Location: page-4.php');
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
      function form($satisfaction, $recommend){ ?>
          <form class="form" method="POST" action="page-3.php">
              <h1 class="heading">Tell us about your recent purchase</h1>
              <div class="block-center">
                  <?php
                    // assign session variable 'purchases' replacing all spaces in values
                    $purchases = str_replace(' ', '', $_SESSION['purchases']);
                    //dynamically generate questions for each purchase
                    foreach ($purchases as $purchase) { ?>
                          <h3>Please complete the following questions for <?php echo $purchase ?> you purchased with us:</h3>
                          <label>How happy are you with <?php echo $purchase ?> on a scale from 1 (not satisfied) to 5 (very satisfied)?</label><br>
                          <!-- echo 'checked' if meet condition (works only for the last group of question, can't figure out why) -->
                          <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == $purchase . "1") echo 'checked' ?> value="<?php echo $purchase ?>1"> <label>1</label>
                          <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == $purchase . "2") echo 'checked' ?> value="<?php echo $purchase ?>2"> <label>2</label>
                          <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == $purchase . "3") echo 'checked' ?> value="<?php echo $purchase ?>3"> <label>3</label>
                          <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == $purchase . "4") echo 'checked' ?> value="<?php echo $purchase ?>4"> <label>4</label>
                          <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == $purchase . "5") echo 'checked' ?> value="<?php echo $purchase ?>5"> <label>5</label> <br><br>
                          <label>Would you recommend the purchase of <?php echo $purchase ?> to a friend?<br></label>
                          <select name="recommend<?php echo $purchase ?>">
                            <option value=""></option>
                            <!-- echo 'selected' if meet condition -->
                            <option <?php if ($recommend == $purchase . "Yes") echo 'selected' ?> value="<?php echo $purchase ?>Yes">Yes</option>
                            <option <?php if ($recommend == $purchase . "No") echo 'selected' ?> value="<?php echo $purchase ?>No">No</option>
                          </select>
                          <br><br>
                    <?php   } ?>
                  <br>
                  <input class="btn" type="submit" name="page-3" value="Next">
              </div>
          </form>
      <?php } ?>

      <?php
      //validation
        function validate_fields(){
          $error_msg = array();
          $purchases = str_replace(' ', '', $_SESSION['purchases']);
          foreach ($purchases as $purchase) {
              $satisfactionPost = 'satisfaction' . $purchase;
              $recommendPost = 'recommend' . $purchase;
              if (!isset($_POST[$satisfactionPost])){
                  $error_msg[] = "One radio button must be selected for " . $purchase;
                  //add empty value
                  $_POST[$satisfactionPost] = '';
              } else if (isset($_POST[$satisfactionPost])) {
                  $satisfaction = $_POST[$satisfactionPost];
              }
              if (empty($_POST[$recommendPost])){
                  $error_msg[] = "The empty option cannot be selected for " . $purchase;
              } else if (isset($_POST[$recommendPost])) {
                  $recommend  = $_POST[$recommendPost];
              }
              if (count($error_msg) == 0){
                  //pass variables to session if no errors
                  $_SESSION[$satisfactionPost] = $satisfaction;
                  $_SESSION[$recommendPost] = $recommend;
              }
          }
          return $error_msg;
      } ?>
  </body>
</html>