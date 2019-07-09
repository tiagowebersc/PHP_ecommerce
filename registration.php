<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - Registration</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    require_once 'header.php';
    $firstName = "";
    $lastName = "";
    $address = "";
    $email = "";
    $password = "";
    $confirmPassword = "";
    $error = "";

    if (isset($_POST['registerButton'])) {
        // recover the data passed on POST method
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $address = htmlspecialchars($_POST['address']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
        // show an erro if some field was not informed
        if (empty($firstName)) $error = "First name must be informed!";
        else if (empty($lastName)) $error = "Last name must be informed!";
        else if (empty($address)) $error = "Address must be informed!";
        else if (empty($email)) $error = "Email must be informed!";
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = "Invalid email format!";
        else if (empty($password)) $error = "Password must be informed!";
        else if (empty($confirmPassword)) $error = "Confirmation password must be informed!";
        else if ($password != $confirmPassword) $error = "Password don\'t match!";

        if (empty($error)) {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $dbFound = mysqli_select_db($conn, DB_NAME);
            if (!$dbFound) {
                $error = 'Problem to connect to the database!!';
            } else {
                $query = "SELECT * FROM User WHERE email = '" . $email . "';";
                $results = mysqli_query($conn, $query);
                if (mysqli_fetch_assoc($results)) {
                    $error = 'Email already registered!!';
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                    $query = 'INSERT INTO User(firstName, lastName, address, email, hashPassword, isAdministrator) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $address . '", "' . $email . '", "' . $hashedPass . '", 0)';
                    var_dump($query);
                    $result = mysqli_query($conn, $query);

                    if (!$result)
                        $error =  "Insert went wrong!";
                    else {
                        $query = "SELECT idUser FROM User WHERE email = '" . $email . "';";
                        $results = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($results);
                        session_start();
                        $_SESSION['id'] = $row['idUser'];
                        $_SESSION['name'] = $firstName . " " . $lastName;
                        $_SESSION['email'] = $email;
                        mysqli_close($conn);
                        header("Location: index.php");
                    }
                }
            }
            mysqli_close($conn);
        }
    }
    ?>
    <form class="formLogin" action="" method="post">
        <h2>Registration</h2>
        <label for="firstName">First name:</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>" placeholder='Enter your first name'>
        <label for="lastName">Last name:</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>" placeholder='Enter your last name'>
        <label for="lastName">Address:</label>
        <textarea name="address" id="address" placeholder='Enter your address'><?php echo $address; ?></textarea>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder='Enter your email'>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder='Enter your password'>
        <label for="confirmPassword">Confirm your password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" value="<?php echo $confirmPassword; ?>" placeholder='Repeate your password'>
        <span class="error"><?php echo $error; ?></span>
        <input type="submit" value="New account" name="registerButton">
    </form>
</body>

</html>