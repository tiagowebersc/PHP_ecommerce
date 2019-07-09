<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - Login</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    require_once 'header.php';
    $email = "";
    $password = "";
    $error = "";

    if (isset($_POST['loginButton'])) {
        // recover the data passed on POST method
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        // show an erro if some field was not informed
        if (empty($email)) $error = "First name must be informed!";
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = "Invalid email format!";
        else if (empty($password)) $error = "Password must be informed!";

        if (empty($error)) {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $dbFound = mysqli_select_db($conn, DB_NAME);
            if (!$dbFound) {
                $error = 'Problem to connect to the database!!';
            } else {
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $query = "SELECT * FROM User WHERE email = '" . $email . "' AND hashPassword = '" . $hashedPass . "';";
                var_dump($query);
                $results = mysqli_query($conn, $query);
                if ($row = mysqli_fetch_assoc($results)) {
                    $_SESSION['id'] = $row['idUser'];
                    $_SESSION['name'] = $row['firstName'] . " " . $row['lastName'];
                    $_SESSION['email'] = $row['email'];
                    mysqli_close($conn);
                    header("Location: index.php");
                } else {
                    $error = 'Email not registered/Wrong password!!';
                }
            }
            mysqli_close($conn);
        }
    }
    ?>
    <form class="formLogin" action="" method="post">
        <h2>Login</h2>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder='Enter your email'>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder='Enter your password'>
        <span class="error"><?php echo $error; ?></span>
        <input type="submit" value="Login" name="loginButton">
    </form>
</body>

</html>