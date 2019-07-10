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
    $error = "";
    if (isset($_POST['logoutSubmit'])) {
        session_unset();
        session_destroy();
    }

    ?>
    <form action="" method="post" class="center flex">
        <div class="half">
            <h2>User info</h2>
            <?php
            if (isset($_SESSION['id'])) {
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
                $dbFound = mysqli_select_db($conn, DB_NAME);
                if (!$dbFound) {
                    $error = 'Problem to connect to the database!!';
                } else {
                    $query = "SELECT * FROM `User` where idUser = " . $_SESSION['id'];
                    $results = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($results)) {
                        ?>
                        <ul>
                            <li><strong>ID:</strong><?php echo ' ' . $row['idUser']; ?></li>
                            <li><strong>First name:</strong><?php echo ' ' . $row['firstName']; ?></li>
                            <li><strong>Last name:</strong><?php echo ' ' . $row['lastName']; ?></li>
                            <li><strong>Address:</strong><?php echo ' ' . $row['address']; ?></li>
                            <li><strong>Email:</strong><?php echo ' ' . $row['email']; ?></li>
                        </ul>
                    <?php

                    } else {
                        header("Location: index.php");
                    }
                }
                mysqli_close($conn);
                ?>
                <input class='button' type="submit" value="Logout" name='logoutSubmit'>
            <?php
            } else {
                header("Location: index.php");
            }
            ?>
        </div>
        <div class='half'>
            <h2>Order history</h2>
            <?php
            if (isset($_SESSION['id'])) {
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
                $dbFound = mysqli_select_db($conn, DB_NAME);
                if (!$dbFound) {
                    $error = 'Problem to connect to the database!!';
                } else {
                    $query = "SELECT o.idOrder, o.date, o.address, o.name, p.description as paymentMethod, sum(i.price * i.qtde) as total FROM `Order` o inner join OrderItem i on o.idOrder = i.Order_idOrder inner join PaymentMethod p on o.paymentMethod_idpaymentMethod = p.idPaymentMethod WHERE o.User_idUser = " . $_SESSION['id'] . " GROUP BY o.idOrder, o.date, o.address, o.name, p.description ";
                    $results = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($results)) {
                        ?>
                        <br><br>
                        <div class='flex'>
                            <div class='half'>
                                <span><strong>ID:</strong> <?php echo ' ' . $row['idOrder']; ?></span>
                                <br>
                                <span><strong>Date:</strong><?php echo ' ' . $row['date']; ?></span>
                                <br>
                                <span><strong>Name:</strong><?php echo ' ' . $row['name']; ?></span>
                                <br>
                                <span><strong>Address:</strong><?php echo ' ' . $row['address']; ?></span>
                                <br>
                                <span><strong>Payment method:</strong><?php echo ' ' . $row['paymentMethod']; ?></span>
                                <br>
                                <span><strong>Total:</strong><?php echo ' ' . $row['total']; ?></span>
                            </div>
                            <div class='half'>
                                <a class='a' href="orderDetail.php">Detail</a>
                            </div>
                        </div>
                    <?php
                    }
                }
            }
            ?>
        </div>
    </form>
    <span class="error"><?php echo $error; ?></span>

</body>

</html>