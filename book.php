<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store - Book detail</title>
    <link rel='stylesheet' href='styleBanana/style.css'>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php require_once 'header.php';
    $error = "";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            header("Location: index.php");
        }
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        $dbFound = mysqli_select_db($conn, DB_NAME);
        if (!$dbFound) {
            $error = 'Problem to connect to the database!!';
        } else {
            $query = "SELECT p.cover, p.title, p.price, p.releaseDate
            , c.description as 'category', f.description as 'format' , a.name as 'author', a.yearOfBirth, a.gender, a.biography
            FROM `Product` p 
            inner join `Format` f on p.Format_idFormat = f.idFormat 
            inner join `Category` c on p.Category_idCategory = c.idCategory 
            inner join `Author` a on p.Author_idAuthor = a.idAuthor 
            where p.idProduct = " . $id . " and p.available = 1;";
            $results = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($results)) {
                if (isset($_POST['addCartSubmit'])) {
                    $query = "SELECT * FROM Cart WHERE User_idUser=" . $_SESSION['id'] . " AND Product_idProduct = " . $id;
                    $resultsCart = mysqli_query($conn, $query);
                    if (mysqli_fetch_assoc($resultsCart)) {
                        $query = "UPDATE Cart set qtde = qtde + 1 WHERE User_idUser=" . $_SESSION['id'] . " AND Product_idProduct = " . $id;
                    } else {
                        $query = "INSERT INTO Cart (User_idUser, date, Product_idProduct, qtde) VALUES (" . $_SESSION['id'] . ", now(), " . $id . ", 1)";
                    }
                    $resultsCart = mysqli_query($conn, $query);
                    if (!$resultsCart)
                        $error =  "Problem to add this product to your cart!";
                    else {
                        header("Refresh:0");
                    }
                }

                ?>
                <div class='flex'>
                    <article class="cardBook">
                        <div class="divcover"><img class="cover" src='<?php echo $row['cover']; ?>'></div>
                        <h3 class=""><?php echo $row['title']; ?></h3>
                    </article>
                    <section>
                        <ul>
                            <li><strong>Release Date:</strong> <?php echo $row['releaseDate']; ?></li>
                            <li><strong>Category:</strong> <?php echo $row['category']; ?></li>
                            <li><strong>Format:</strong> <?php echo $row['format']; ?></li>
                            <li><strong>Price:</strong> <?php echo $row['price']; ?></li>
                        </ul>
                        <ul>
                            <li><strong>Author:</strong> <?php echo $row['author']; ?></li>
                            <li><strong>Birthday:</strong> <?php echo $row['yearOfBirth']; ?></li>
                            <li><strong>Gender:</strong> <?php echo $row['gender'] === 'M' ? 'Male' : 'Female'; ?></li>
                            <li><strong>Biography:</strong> <?php echo $row['biography']; ?></li>
                        </ul>
                        <?php
                        if (isset($_SESSION['id'])) {
                            ?>
                            <form action="" method="post">
                                <input class='button' type="submit" value="Add to the cart" name='addCartSubmit'>
                            </form>

                        </section>
                    </div>
                <?php
                }
            } else {
                header("Location: index.php");
            }
        }
        mysqli_close($conn);
    } else {
        header("Location: index.php");
    }

    ?>
    <span class="error"><?php echo $error; ?></span>


</body>

</html>