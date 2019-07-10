<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - Order</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel='stylesheet' href='styleBanana/style.css'>
</head>

<body>
    <?php
    require_once 'header.php';
    $error = "";
    $name = "";
    $address = "";
    $total = 0;
    if (!isset($_SESSION['id'])) header("Location: index.php");
    ?>
    <span class='title'>Order</span>
    <div class='center flex'>
        <?php
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        $dbFound = mysqli_select_db($conn, DB_NAME);
        $total = 0;
        if (!$dbFound) {
            $error = 'Problem to connect to the database!!';
        } else {
            if (isset($_POST['checkoutSubmit'])) {
                $name = htmlspecialchars($_POST['name']);
                $address = htmlspecialchars($_POST['address']);
                $paymentMethod = htmlspecialchars($_POST['paymentMethod']);
                // show an erro if some field was not informed
                if (empty($name)) $error = "Name must be informed!";
                else if (empty($address)) $error = "Address must be informed!";
                else if (empty($paymentMethod)) $error = "Payment method must be informed!";
                if (empty($error)) {
                    // nex order number
                    $query = "SELECT ifnull(max(idOrder),0)+1 as next FROM `Order`";
                    $results = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($results);
                    $orderNr = $row['next'];

                    $query = "INSERT INTO `Order` (idOrder, User_idUser, paymentMethod_idpaymentMethod, date, name, address) VALUES ($orderNr," . $_SESSION['id'] . ", $paymentMethod, now(), '$name', '$address');";
                    $results = mysqli_query($conn, $query);
                    if ($results) {
                        $query = "SELECT c.qtde, p.idProduct, p.price FROM `Cart` c inner join `Product` p on c.Product_idProduct = p.idProduct WHERE c.User_idUser = " . $_SESSION['id'] . ";";
                        $results = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($results)) {
                            $query = "INSERT INTO OrderItem (Order_idOrder, Product_idProduct, qtde, price) VALUES (" . $orderNr . "," . $row['idProduct'] . ", " . $row['qtde'] . "," . $row['price'] . ");";
                            $results2 = mysqli_query($conn, $query);
                        }
                        if ($results2) {
                            $query = "DELETE FROM `Cart` WHERE User_idUser = " . $_SESSION['id'] . ";";
                            $results = mysqli_query($conn, $query);
                            header("Location: index.php");
                        }
                    }
                }
            }

            $query = "SELECT * FROM `Cart` WHERE User_idUser = " . $_SESSION['id'];
            $results = mysqli_query($conn, $query);
            if ($results) {
                $query = "SELECT * FROM `User` WHERE idUser = " . $_SESSION['id'];
                $results = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($results);
                $name = $row['firstName'] . ' ' . $row['lastName'];
                $address = $row['address'];
                $query = "SELECT sum(c.qtde * p.price) as total FROM `Cart` c inner join `Product` p on c.Product_idProduct = p.idProduct WHERE c.User_idUser = " . $_SESSION['id'];
                $results = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($results);
                $total += $row['total'];
                ?>
                <form class="center" action="" method="post">

                    <label for="Name">First name:</label>
                    <input class="inputLine" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder='Enter your name'><br>
                    <label for="lastName">Address:</label>
                    <textarea class="inputLine" name="address" id="address" placeholder='Enter your address'><?php echo $address; ?></textarea>
                    <h2><strong>Total:</strong><?php echo $total; ?></h2>

                    <h3>Payment method</h3>

                    <?php
                    $query = "SELECT * FROM `PaymentMethod`";
                    $results = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($results)) {
                        ?>
                        <label>
                            <input type="radio" name=" paymentMethod" value="<?php echo $row['idPaymentMethod']; ?>" checked>
                            <img src="<?php echo $row['icon']; ?>">
                        </label>
                    <?php
                    }
                    ?>
                    <input class='button bestSeller' type="submit" value="Check out" name='checkoutSubmit'>
                </form>
            <?php } else {
                $error = " Not items in the cart to  order!";
            }
        }
        mysqli_close($conn); ?> </div> <span c lass="error"><?php echo $error; ?></span>

</body>

</html>