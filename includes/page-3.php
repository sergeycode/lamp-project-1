<?php
    //form 3
    function form_3(){
        //assign variables with empty values
        $satisfaction = "";
        $recommend = "";
        //assign session variable 'purchases' replacing all spaces in values
        $purchases = str_replace(' ', '', $_SESSION['purchases']);
        //for each purchase add to the variable name purchase name, for example 'satisfactionPhone' etc.
        foreach ($purchases as $purchase) {
            $satisfactionEach = 'satisfaction' . $purchase;
            $recommendEach = 'recommend' . $purchase;
            //if session (and post) variable is set than assign its value to variable which will be used
            //to echo 'checked' or 'selected' into the input of the form
            if (isset($_SESSION[$satisfactionEach])){
                $satisfaction = $_SESSION[$satisfactionEach];
            } else if (isset($_POST[$satisfactionEach])){
                $satisfaction = $_POST[$satisfactionEach];
            }
            if (isset($_SESSION[$recommendEach])){
                $recommend = $_SESSION[$recommendEach];
            } else if (isset($_POST[$recommendEach])){
                $recommend = $_POST[$recommendEach];
            }
        }
?>
<form class="form" method="POST">
    <h1 class="heading">Tell us about your recent purchase</h1>
    <div class="block-center">
        <?php
        // assign session variable 'purchases' replacing all spaces in values
        $purchases = str_replace(' ', '', $_SESSION['purchases']);
        //dynamically generate questions for each purchase
        foreach ($purchases as $purchase) { ?>
            <h3>Please complete the following questions for <?php echo $purchase ?> you purchased with us:</h3>
            <label>How happy are you with <?php echo $purchase ?> on a scale from 1 (not satisfied) to 5 (very satisfied)?</label><br>
            <!-- output 'checked' if meet condition -->
            <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == "1") echo 'checked' ?> value="1"> <label>1</label>
            <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == "2") echo 'checked' ?> value="2"> <label>2</label>
            <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == "3") echo 'checked' ?> value="3"> <label>3</label>
            <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == "4") echo 'checked' ?> value="4"> <label>4</label>
            <input type="radio" name="satisfaction<?php echo $purchase ?>" <?php if ($satisfaction == "5") echo 'checked' ?> value="5"> <label>5</label> <br><br>
            <label>Would you recommend the purchase of <?php echo $purchase ?> to a friend?<br></label>
            <select name="recommend<?php echo $purchase ?>">
                <option value=""></option>
                <!-- output 'selected' if meet condition -->
                <option <?php if ($recommend == "Yes") echo 'selected' ?> value="Yes">Yes</option>
                <option <?php if ($recommend == "No") echo 'selected' ?> value="No">No</option>
            </select>
            <br><br>
        <?php   } ?>
        <br>
        <input class="btn" type="submit" value="Next">
    </div>
</form>
<?php } ?>

<?php
//validation
function validate_form_3(){
    $error_msg = array();
    $purchases = str_replace(' ', '', $_SESSION['purchases']);
    foreach ($purchases as $purchase) {
        $satisfactionEach = 'satisfaction' . $purchase;
        $recommendEach = 'recommend' . $purchase;
        if (!isset($_POST[$satisfactionEach])){
            $error_msg[] = "One radio button must be selected for " . $purchase;
        } else if (isset($_POST[$satisfactionEach])) {
            $satisfaction = $_POST[$satisfactionEach];
        }
        if (empty($_POST[$recommendEach])){
            $error_msg[] = "The empty option cannot be selected for " . $purchase;
        } else if (isset($_POST[$recommendEach])) {
            $recommend  = $_POST[$recommendEach];
        }
        if (count($error_msg) == 0){
            //pass variables to session if no errors
            $_SESSION[$satisfactionEach] = $satisfaction;
            $_SESSION[$recommendEach] = $recommend;
        }
    }
    return $error_msg;
} ?>