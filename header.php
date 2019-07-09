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
        if (isset($_SESSION['email'])) {
            $name = $_SESSION['name'];
        } else { }
        ?>
        <input type="button" value="Test3">
        <input type="button" value="Test4">
    </div>
</header>