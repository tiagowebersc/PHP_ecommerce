<?php
require_once 'database.php';
session_start();
?>
<header>
    <div>
        <input type="button" value="Test1">
        <input type="button" value="Test2">
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