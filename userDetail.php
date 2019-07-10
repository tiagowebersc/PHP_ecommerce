<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - User detail</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    require_once 'header.php';
    ?>
    <span class='title'>User info</span>
    <form action="" method="post" class="center">
        <ul>
            <li><strong>ID:</strong></li>
            <li><strong>First name:</strong></li>
            <li><strong>Last name:</strong></li>
            <li><strong>Address:</strong></li>
            <li><strong>Email:</strong></li>
        </ul>
        <?php
        if (isset($_SESSION['id'])) {
            ?>

            <input class='button' type="submit" value="Logout" name='logoutSubmit'>

        <?php } ?>
    </form>

</body>

</html>