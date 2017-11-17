<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Project 1 Ovcharenko</title>
  </head>
  <body>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){

      if (isset($_SESSION['part']) && ($_SESSION['part'] == 1)) {
          $_SESSION['part'] = 2;
          if (!isset($_SESSION['fullName'])) {
              form_1("", "", "");
          } else {
              form_1($_SESSION['fullName'], $_SESSION['age'], $_SESSION['student']);
          }
      } else if (isset($_SESSION['part']) && ($_SESSION['part'] == 2)){
    		if (isset($_POST['fullName'])){
    			$_SESSION['fullName'] = $_POST['fullName'];
    		}
    		if (isset($_POST['age'])){
    			$_SESSION['age'] = $_POST['age'];
    		}
            if (isset($_POST['student'])){
    			$_SESSION['student'] = $_POST['student'];
    		}

            $error_msg = validate_fields1();
            if (count($error_msg) > 0){
              display_error($error_msg);
              form_1($_POST['fullName'], $_POST['age'], $_POST['student']);
            } else {
              $_SESSION['part'] = 3;
                if (!isset($_SESSION['howPurchased'])) {
                    form_2("", "");
                } else {
                    form_2($_SESSION['howPurchased'], $_SESSION['purchases']);
                }
            }

    	} else if (isset($_SESSION['part']) && ($_SESSION['part'] == 3)){
    		if (isset($_POST['howPurchased'])){
    			$_SESSION['howPurchased'] = $_POST['howPurchased'];
    		}
    		if (isset($_POST['purchases'])){
    			$_SESSION['purchases'] = $_POST['purchases'];
    		}

          $error_msg = validate_fields2();
          if (count($error_msg) > 0){
              display_error($error_msg);
              form_2($_POST['howPurchased'], $_POST['purchases']);
          } else {
              $_SESSION['part'] = 4;
              if (!isset($_SESSION['satisfaction'])) {
                  form_3("", "");
              } else {
                  form_3($_SESSION['satisfaction'], $_SESSION['recommend']);
              }
          }
    	} else if (isset($_SESSION['part']) && ($_SESSION['part'] == 4)){
    		if (isset($_POST['satisfaction'])){
    			$_SESSION['satisfaction'] = $_POST['satisfaction'];
    		}
    		if (isset($_POST['recommend'])){
    			$_SESSION['recommend'] = $_POST['recommend'];
    		}
          $error_msg = validate_fields3();
          if (count($error_msg) > 0){
              display_error($error_msg);
              $purchases = str_replace(' ', '', $_SESSION['purchases']);
              foreach ($purchases as $purchase) {
                  $satisfactionPost1 = $_POST['satisfaction' . $purchase];
                  $recommendPost1 = $_POST['recommend' . $purchase];
              }
              form_3($satisfactionPost1, $recommendPost1);
          } else {
              thankyou();
          }
    	}
    } else {
      $_SESSION['part'] = 1;
    	intro();
    } ?>

    <?php function display_error($error_msg){
      echo "<p>\n";
      foreach($error_msg as $v){
        echo $v."<br>\n";
      }
      echo "</p>\n";
    } ?>

    <?php function intro(){ ?>
      <form method="POST" action="index_old.php">
        <h1>Customer satisfaction survey</h1>
        <p>
          Hi! Welcome to the customer satisfaction survey. <br>
          Please, answer some questions based on your recent purchase. <br>
          After clicking Begin button, the survey will be started.
        </p>
        <button type="submit">Begin</button>
      </form>
    <?php } ?>
    <?php function form_1($fullName, $age, $student){ ?>
      <form method="POST" action="index_old.php">
        <label for="full_name">Full name</label>
        <input type="text" id="full_name" name="fullName" value="<?php echo $fullName; ?>">
        <br>
        <label for="age">Your Age</label>
        <input type="text" id="age" name="age" value="<?php echo $age; ?>">
        <br>
        <label for="student">Are you a student?</label>
        <select id="student" name="student">
          <option value=""></option>
          <option <?php if ($student=="Yes, Full Time") echo "selected";?> value="Yes, Full Time">Yes, Full Time</option>
          <option <?php if ($student=="Yes, Part Time") echo "selected";?> value="Yes, Part Time">Yes, Part Time</option>
          <option <?php if ($student=="No") echo "selected";?> value="No">No</option>
        </select>
        <br>
        <input type="submit" value="Next">
      </form>
    <?php } ?>
    <?php function form_2($howPurchased, $purchases){ ?>
      <form method="POST" action="index_old.php">
        <h3>How did you complete your purchase?</h3>
        <input type="radio" id="online" name="howPurchased" <?php if ($howPurchased=="Online") echo "checked";?> value="Online"> <label for="online">Online</label>
        <input type="radio" id="byphone" name="howPurchased" <?php if ($howPurchased=="By phone") echo "checked";?> value="By phone"> <label for="byphone">By phone</label>
        <input type="radio" id="mobileapp" name="howPurchased" <?php if ($howPurchased=="Mobile App") echo "checked";?> value="Mobile App"> <label for="mobileapp">Mobile App</label>
        <input type="radio" id="instore" name="howPurchased" <?php if ($howPurchased=="In store") echo "checked";?> value="In store"> <label for="instore">In store</label>
        <br>
        <h3>Which of the following did you purchase?</h3>
        <input type="checkbox" id="phone" name="purchases[]" <?php if (isset($_POST['purchases']) && (in_array("Phone", $purchases))) echo "checked";?> value="Phone"> <label for="phone">Phone</label>
        <input type="checkbox" id="smartv" name="purchases[]" <?php if (isset($_POST['purchases']) && (in_array("Smart TV", $purchases))) echo "checked";?> value="Smart TV"> <label for="smartv">Smart TV</label>
        <input type="checkbox" id="laptop" name="purchases[]" <?php if (isset($_POST['purchases']) && (in_array("Laptop", $purchases))) echo "checked";?> value="Laptop"> <label for="laptop">Laptop</label>
        <input type="checkbox" id="tablet" name="purchases[]" <?php if (isset($_POST['purchases']) && (in_array("Tablet", $purchases))) echo "checked";?> value="Tablet"> <label for="tablet">Tablet</label>
        <input type="checkbox" id="hometheater" name="purchases[]" <?php if (isset($_POST['purchases']) && (in_array("Home Theater", $purchases))) echo "checked";?> value="Home Theater"> <label for="hometheater">Home Theater</label>
        <br>
        <input type="submit" value="Next">
      </form>
    <?php } ?>
    <?php function form_3($satisfaction, $recommend){ ?>
      <form method="POST" action="index_old.php">
<!---->
<!--        <label>How happy are you with this device on a scale from 1 (not satisfied) to 5 (very satisfied)?</label>-->
<!--        <br>-->
<!--        <input type="radio" id="satisfaction1" name="satisfaction" --><?php //if ($satisfaction=="1") echo "checked";?><!-- value="1"> <label for="satisfaction1">1</label>-->
<!--        <input type="radio" id="satisfaction2" name="satisfaction" --><?php //if ($satisfaction=="2") echo "checked";?><!-- value="2"> <label for="satisfaction2">2</label>-->
<!--        <input type="radio" id="satisfaction3" name="satisfaction" --><?php //if ($satisfaction=="3") echo "checked";?><!-- value="3"> <label for="satisfaction3">3</label>-->
<!--        <input type="radio" id="satisfaction4" name="satisfaction" --><?php //if ($satisfaction=="4") echo "checked";?><!-- value="4"> <label for="satisfaction4">4</label>-->
<!--        <input type="radio" id="satisfaction5" name="satisfaction" --><?php //if ($satisfaction=="5") echo "checked";?><!-- value="5"> <label for="satisfaction5">5</label>-->
<!--        <br>-->
<!--        <label for="recommend">Would you recommend the purchase of this device to a friend?</label>-->
<!--        <select id="recommend" name="recommend">-->
<!--          <option value=""></option>-->
<!--          <option --><?php //if ($recommend=="Yes") echo "selected";?><!-- value="Yes">Yes</option>-->
<!--          <option --><?php //if ($recommend=="No") echo "selected";?><!-- value="No">No</option>-->
<!--        </select>-->
<!--        <br>-->
          <?php
            $purchases = str_replace(' ', '', $_SESSION['purchases']);
            foreach ($purchases as $purchase) {
                echo '<h3>Please complete the following questions for ' . $purchase . ' you purchased with us:</h3>';
                echo '<label>How happy are you with ' . $purchase . ' on a scale from 1 (not satisfied) to 5 (very satisfied)?</label><br>';
                echo '<input type="radio" name="satisfaction' . $purchase . '" value="1"> <label>1</label> ';
                echo '<input type="radio" name="satisfaction' . $purchase . '" value="2"> <label>2</label> ';
                echo '<input type="radio" name="satisfaction' . $purchase . '" value="3"> <label>3</label> ';
                echo '<input type="radio" name="satisfaction' . $purchase . '" value="4"> <label>4</label> ';
                echo '<input type="radio" name="satisfaction' . $purchase . '" value="5"> <label>5</label> <br><br>';
                echo '<label>Would you recommend the purchase of ' . $purchase . ' to a friend?<br></label>';
                echo '
                    <select name="recommend' . $purchase . '">
                      <option value=""></option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    <br><br>
                ';
            }
          ?>
        <br>
        <input type="submit" value="Submit">
      </form>
    <?php } ?>
    <?php function thankyou(){ ?>
        <h2>Thank you!</h2>
        <h3>Here are your answers:</h3>
        <table>
            <tr>
                <th>Full name</th>
                <th>Your Age</th>
                <th>Are you a student?</th>
                <th>How did you complete your purchase?</th>
                <th>Which of the following did you purchase?</th>
            </tr>
            <tr>
                <td><?php echo $_SESSION['fullName'] ?></td>
                <td><?php echo $_SESSION['age'] ?></td>
                <td><?php echo $_SESSION['student'] ?></td>
                <td><?php echo $_SESSION['howPurchased'] ?></td>
                <td><?php echo implode(", ", $_SESSION['purchases']) ?></td>
            </tr>
        </table>

        <?php session_destroy(); ?>
    <?php } ?>

    <!-- validation 1 -->
    <?php function validate_fields1(){
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
            $_SESSION['fullName'] = $fullName;
            $_SESSION['age'] = $age;
            $_SESSION['student'] = $student;
        }
        return $error_msg;
    } ?>

    <!-- validation 2 -->
    <?php function validate_fields2(){
        $error_msg = array();
        if (!isset($_POST['howPurchased'])){
            $error_msg[] = "One checkbox must be selected";
        } else if (isset($_POST['howPurchased'])) {
            $howPurchased = $_POST['howPurchased'];
        }
        if (!isset($_POST['purchases'])){
            $error_msg[] = "At least one option must be selected";
        } else if (isset($_POST['purchases'])) {
            $purchases = $_POST['purchases'];
        }
        if (count($error_msg) == 0){
            $_POST['howPurchased'] = $howPurchased;
            $_POST['purchases'] = $purchases;
        }
        return $error_msg;
    } ?>

    <!-- validation 3 -->
    <?php function validate_fields3(){
        $error_msg = array();
        $purchases = str_replace(' ', '', $_SESSION['purchases']);
        foreach ($purchases as $purchase) {
            $satisfactionPost = 'satisfaction' . $purchase;
            $recommendPost = 'recommend' . $purchase;
            if (!isset($_POST[$satisfactionPost])){
                $error_msg[] = "One option must be selected for " . $purchase;
            } else if (isset($_POST[$satisfactionPost])) {
                $satisfaction = $_POST[$satisfactionPost];
            }
            if (empty($_POST[$recommendPost])){
                $error_msg[] = "The empty option cannot be selected for " . $purchase;
            } else if (isset($_POST[$recommendPost])) {
                $recommend  = $_POST[$recommendPost];
            }
            if (count($error_msg) == 0){
                $_POST[$satisfactionPost] = $satisfaction ;
                $_POST[$recommendPost] = $recommend;
            }
        }
        return $error_msg;
    } ?>
  </body>
</html>
