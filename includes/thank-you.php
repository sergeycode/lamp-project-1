<?php function thankyou(){ ?>
    <div class="form">
        <h1 class="heading">Thank you</h1>
        <div>
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
                    <!-- echo values of session variables to the table -->
                    <td><?php echo $_SESSION['fullName'] ?></td>
                    <td><?php echo $_SESSION['age'] ?></td>
                    <td><?php echo $_SESSION['student'] ?></td>
                    <td><?php echo $_SESSION['howPurchased'] ?></td>
                    <td><?php echo implode(", ", $_SESSION['purchases']) ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Purchase</th>
                    <th>How happy are you with this purchase?</th>
                    <th>Would you recommend this purchase to a friend?</th>
                </tr>
                <?php
                $purchases = str_replace(' ', '', $_SESSION['purchases']);
                // echo values for each purchase
                foreach ($purchases as $purchase) {
                    $satisfaction = 'satisfaction' . $purchase;
                    $recommend = 'recommend' . $purchase;
                    echo '<tr>';
                    echo '<td>' . $purchase . '</td>';
                    echo '<td>' . $_SESSION[$satisfaction] . '</td>';
                    echo '<td>' . $_SESSION[$recommend] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </div>
<?php } ?>