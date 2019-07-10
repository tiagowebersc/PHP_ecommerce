<?php
require_once 'database.php';
session_start();
?>
<header>
    <div>
        <a class='a' href="index.php">Home</a>
        <?php
        if (isset($_SESSION['id'])) {
            echo '<a class=\'a\' href="userDetail.php">User Info</a>';
        }
        ?>
        <a class='a' href="contact.php">Contact Us</a>
    </div>

    <div>
        <?php
        if (isset($_SESSION['id'])) {
            $name = $_SESSION['name'];
            $qtdeCart = 0;
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $dbFound = mysqli_select_db($conn, DB_NAME);
            $query = "SELECT ifnull(sum(qtde) ,0) as 'qtde' FROM `Cart` WHERE User_idUser = " . $_SESSION['id'];
            $resultsCart = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($resultsCart);
            $qtdeCart += $row['qtde'];

            mysqli_close($conn);
            ?>
            <div class='cart'>
                <span>Wellcome <?php echo $name; ?></span>
                <a href="cart.php"><img src="images/shopping-cart.png" alt="Cart"></a>
                <span><?php echo $qtdeCart; ?></span>
            </div>
        <?php
        } else {
            ?>
            <a class='a' href="registration.php">Registration</a>
            <a class='a' href="login.php">Login</a>
        <?php
        }
        ?>
    </div>
</header>