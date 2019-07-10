<?php
require_once 'database.php';
session_start();
?>
<header>
    <div>
        <a href="index.php">Home</a>
        <a href="userDetail.php">User Info</a>
        <a href="contact.php">Contact Us</a>
    </div>

    <div>
        <?php
        if (isset($_SESSION['id'])) {
            $name = $_SESSION['name'];
            ?>
            <div class='cart'>
                <span>Wellcome <?php echo $name; ?></span>
                <img src="images/shopping-cart.png" alt="Cart">
                <span><?php echo 2; ?></span>
            </div>
        <?php
        } else {
            ?>
            <a href="registration.php">Registration</a>
            <a href="login.php">Login</a>
        <?php
        }
        ?>
    </div>
</header>