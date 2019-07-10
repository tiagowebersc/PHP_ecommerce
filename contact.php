<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - Contact Us</title>
    <link rel="stylesheet" href="style/style.css">

</head>

<body>
    <?php
    require_once 'header.php';
    $email = "";
    $message = "";
    $error = "";
    ?>

    <form class="formLogin" action="" method="post">
        <h2>Contact Us</h2>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder='Enter your email'>
        <label for="lastName">Message:</label>
        <textarea name="message" id="message" placeholder='Enter your messge'><?php echo $message; ?></textarea>
        <span class="error"><?php echo $error; ?></span>
        <input type="submit" value="Send" name="contactButton">
    </form>
</body>

</html>