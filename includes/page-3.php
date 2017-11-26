<?php
    //form 3
    function form_3(){ ?>
<form class="form" method="POST">
    <h1 class="heading">Tell us about your recent purchase</h1>
    <div class="block-center">
        <?php
        // assign session variable 'purchases' replacing all spaces in values
        $purchases = str_replace(' ', '', $_SESSION['purchases']);
        //dynamically output questions for each purchase
        foreach ($purchases as $purchase) {
            //for each purchase add to the variable name purchase name, for example 'satisfactionPhone' etc.
            $satisfactionEach = 'satisfaction' . $purchase;
            $recommendEach = 'recommend' . $purchase;
        ?>
        <h3>Please complete the following questions for <?php echo $purchase ?> you purchased with us:</h3>
        <label>How happy are you with <?php echo $purchase ?> on a scale from 1 (not satisfied) to 5 (very satisfied)?</label><br>
        <input type="radio" name="satisfaction<?php echo $purchase ?>"
            <?php
                //output 'checked' if session (or post) variable is set and equals 1
                if ((isset($_SESSION[$satisfactionEach]) && ($_SESSION[$satisfactionEach] == "1")) || (isset($_POST[$satisfactionEach]) && ($_POST[$satisfactionEach] == "1"))) {
                    echo 'checked';
                }
            ?>
        value="1"> <label>1</label>
        <input type="radio" name="satisfaction<?php echo $purchase ?>"
            <?php
                //output 'checked' if session (or post) variable is set and equals 2
                if ((isset($_SESSION[$satisfactionEach]) && ($_SESSION[$satisfactionEach] == "2")) || (isset($_POST[$satisfactionEach]) && ($_POST[$satisfactionEach] == "2"))) {
                    echo 'checked';
                }
            ?>
        value="2"> <label>2</label>
        <input type="radio" name="satisfaction<?php echo $purchase ?>"
            <?php
                //output 'checked' if session (or post) variable is set and equals 3
                if ((isset($_SESSION[$satisfactionEach]) && ($_SESSION[$satisfactionEach] == "3")) || (isset($_POST[$satisfactionEach]) && ($_POST[$satisfactionEach] == "3"))) {
                    echo 'checked';
                }
            ?>
        value="3"> <label>3</label>
        <input type="radio" name="satisfaction<?php echo $purchase ?>"
            <?php
                //output 'checked' if session (or post) variable is set and equals 4
                if ((isset($_SESSION[$satisfactionEach]) && ($_SESSION[$satisfactionEach] == "4")) || (isset($_POST[$satisfactionEach]) && ($_POST[$satisfactionEach] == "4"))) {
                    echo 'checked';
                }
            ?>
        value="4"> <label>4</label>
        <input type="radio" name="satisfaction<?php echo $purchase ?>"
            <?php
                //output 'checked' if session (or post) variable is set and equals 5
                if ((isset($_SESSION[$satisfactionEach]) && ($_SESSION[$satisfactionEach] == "5")) || (isset($_POST[$satisfactionEach]) && ($_POST[$satisfactionEach] == "5"))) {
                    echo 'checked';
                }
            ?>
        value="5"> <label>5</label> <br><br>
        <label>Would you recommend the purchase of <?php echo $purchase ?> to a friend?<br></label>
        <select name="recommend<?php echo $purchase ?>">
            <option value=""></option>
            <option
                <?php
                    //output 'selected' if session (or post) variable is set and equals 'Yes'
                    if ((isset($_SESSION[$recommendEach]) && ($_SESSION[$recommendEach] == "Yes")) || (isset($_POST[$recommendEach]) && ($_POST[$recommendEach] == "Yes"))) {
                        echo 'selected';
                    }
                ?>
            value="Yes">Yes</option>
            <option
                <?php
                    //output 'selected' if session (or post) variable is set and equals 'No'
                    if ((isset($_SESSION[$recommendEach]) && ($_SESSION[$recommendEach] == "No")) || (isset($_POST[$recommendEach]) && ($_POST[$recommendEach] == "No"))) {
                        echo 'selected';
                    }
                ?>
            value="No">No</option>
        </select>
        <br><br>
        <?php   } ?>
        <br>
        <input class="btn" type="submit" name="back" value="Back">
        <input class="btn" type="submit" name="next" value="Next">
    </div>
</form>
<?php } ?>

<?php
//validation
function validate_form_3(){
    $error_msg = array();
    $purchases = str_replace(' ', '', $_SESSION['purchases']);
    foreach ($purchases as $purchase) {
        //for each purchase add to the variable name purchase name, for example 'satisfactionPhone' etc.
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