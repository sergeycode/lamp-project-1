<?php
    //form 2
    function form_2(){
        //assign variables with empty values
        $howPurchased = "";
        $purchases = [];
        //if session (and post) variable is set than assign its value to variable which will be used
        //to echo 'checked' into the input of the form
        if (isset($_SESSION['howPurchased'])){
            $howPurchased = $_SESSION['howPurchased'];
        } else if (isset($_POST['howPurchased'])){
            $howPurchased = $_POST['howPurchased'];
        }
        if (isset($_SESSION['purchases'])){
            $purchases = $_SESSION['purchases'];
        } else if (isset($_POST['purchases'])){
            $purchases = $_POST['purchases'];
        }
    ?>
    <form class="form" method="POST">
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
        <input class="btn" type="submit" name="back" value="Back">
        <input class="btn" type="submit" name="next" value="Next">
    </form>
<?php } ?>

<?php
//validation
function validate_form_2(){
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