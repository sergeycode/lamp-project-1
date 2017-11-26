<?php
    //form 1
    function form_1(){
        //assign variables with empty values
        $fullName = "";
        $age = "";
        $student = "";
        //if session (and post) variable is set - assign its value to variable which will be used
        //to populate its value to the form
        if (isset($_SESSION['fullName'])){
            $fullName = $_SESSION['fullName'];
        } else if (isset($_POST['fullName'])){
            $fullName = $_POST['fullName'];
        }
        if (isset($_SESSION['age'])){
            $age = $_SESSION['age'];
        } else if (isset($_POST['age'])){
            $age = $_POST['age'];
        }
        if (isset($_SESSION['student'])){
            $student = $_SESSION['student'];
        } else if (isset($_POST['student'])){
            $student = $_POST['student'];
        }
    ?>
    <form class="form" method="POST">
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
            <input class="btn" type="submit" name="back" value="Back">
            <input class="btn" type="submit" name="next" value="Next">
        </div>
    </form>
<?php } ?>

<?php
//validation
function validate_form_1(){
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