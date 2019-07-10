<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - Cart</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel='stylesheet' href='styleBanana/style.css'>
</head>

<body>
    <?php
    require_once 'header.php';
    $error = "";
    if (!isset($_SESSION['id'])) header("Location: index.php");
    ?>
    <span class='title'>Cart</span>
    <div class='center flex'>
        <ul>
            <?php
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $dbFound = mysqli_select_db($conn, DB_NAME);
            $total = 0;
            if (!$dbFound) {
                $error = 'Problem to connect to the database!!';
            } else {
                if (isset($_POST['removeSubmit'])) {
                    $query = "DELETE FROM Cart WHERE Product_idProduct = " . $_POST['book'];
                    $results = mysqli_query($conn, $query);
                    if (!$results) {
                        $error = "Erro trying remove item from cart!";
                    } else {
                        header("Refresh:0");
                    }
                }


                $query = "SELECT p.idProduct, p.cover, p.title, c.date, c.qtde, p.price FROM `Cart` c inner join `Product` p on c.Product_idProduct = p.idProduct WHERE c.User_idUser = " . $_SESSION['id'];
                $results = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($results)) {
                    $total += ($row['qtde'] * $row['price']);
                    ?>
                    <li>
                        <article class='flex'>
                            <div><a href="book.php?id=<?php echo $row['idProduct'] ?>"><img class="mini" src='<?php echo $row['cover'] ?>'></a></div>
                            <div>
                                <h3 class="noMargin"><?php echo $row['title'] ?></h3>
                                <span><strong>Date added to cart: </strong><?php echo $row['date'] ?></span><br>
                                <span><strong>Qtde: </strong><?php echo $row['qtde'] ?></span><br>
                                <span><strong>Price/Unity: </strong><?php echo $row['price'] ?></span><br>
                                <form action="" method="post">
                                    <input type="hidden" name="book" value="<?php echo $row['idProduct']; ?>">
                                    <input class='button' type="submit" value="Remove" name='removeSubmit'>
                                </form>
                            </div>
                        </article>
                    </li>
                <?php
                }
            }
            mysqli_close($conn);
            ?>
            <li>
                <span><strong>Total: </strong><?php echo $total; ?></span>

            </li>
            <li><a class='listBook' href="order.php">Order</a></li>
        </ul>
    </div>

    <span class="error"><?php echo $error; ?></span>
</body>

</html>