<?php
    //function to display validation errors
    function display_error($error_msg){
        echo '<div class="error-msg">';
        foreach($error_msg as $v){
            echo $v . '<br>';
        }
        echo '</div>';
    }
?>