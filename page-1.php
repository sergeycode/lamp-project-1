<?php
    //start the session
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Survey. Page 1. Project 1 Ovcharenko</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
      <?php
        //if session begin is set
        if (isset($_SESSION['begin'])) {
            //if session fullName is not set
            if (!isset($_SESSION['fullName'])) {
                //load empty form
                form("", "", "");
            } else {
                //load session variables to form
                form($_SESSION['fullName'], $_SESSION['age'], $_SESSION['student']);
            }
            // assign null to session variable 'begin' so the post request can be sent
            $_SESSION['begin'] = null;
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //if post request sent
            //validation
            $error_msg = validate_fields();
            if (count($error_msg) > 0){
              //display errors
              display_error($error_msg);
              //pass post variables to form
              form($_POST['fullName'], $_POST['age'], $_POST['student']);
            } else {
                //assign page-1 to session so you can't access page-2 directly
                $_SESSION['page-1'] = $_POST['page-1'];
                //move to page-2
                header('Location: page-2.php');
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
    function form($fullName, $age, $student){ ?>
      <form class="form" method="POST" action="page-1.php">
        <h1 class="heading">Tell us about yourself</h1>
        <div class="block-center">
            <label for="full_name">Full name</label>
            <input type="text" id="full_name" name="fullName" value="<?php echo $fullName; ?>">
            <br>
            <label for="age">Your Age</label>
            <input type="text" id="age" name="age" value="<?php echo $age; ?>">
            <br>
            <label for="student">Are you a student?</label>
            <select id="student" name="student">
                <option value=""></option>
                <!-- echo 'selected' if meet condition -->
                <option <?php if ($student=="Yes, Full Time") echo "selected";?> value="Yes, Full Time">Yes, Full Time</option>
                <option <?php if ($student=="Yes, Part Time") echo "selected";?> value="Yes, Part Time">Yes, Part Time</option>
                <option <?php if ($student=="No") echo "selected";?> value="No">No</option>
            </select>
            <br>
            <input class="btn" type="submit" name="page-1" value="Next">
        </div>
      </form>
    <?php } ?>

    <?php
    //validation
    function validate_fields(){
        $error_msg = array();
        if (!isset($_POST['fullName'])){
            $error_msg[] = "Full name field not defined";
        } else if (isset($_POST['fullName'])){
            $fullName = trim($_POST['fullName']);
            if (empty($fullName)){
                $error_msg[] = "The Full name field is empty";
            }
        }
        if (!isset($_POST['age'])){
            $error_msg[] = "Age field not defined";
        } else if (isset($_POST['age'])){
            $age = trim($_POST['age']);
            if (empty($age)){
                $error_msg[] = "Age field is empty";
            } else if (!is_numeric($age)){
                    $error_msg[] = "Age field must be numeric";
            }
        }
        if (!isset($_POST['student'])){
            $error_msg[] = "Student field not defined";
        } else if (isset($_POST['student'])){
            $student = $_POST['student'];
            if (empty($student)){
                $error_msg[] = "Student field: the empty option cannot be selected";
            }
        }
        if (count($error_msg) == 0){
            //pass variables to session if no errors
            $_SESSION['fullName'] = $fullName;
            $_SESSION['age'] = $age;
            $_SESSION['student'] = $student;
        }
        return $error_msg;
    } ?>
  </body>
</html>