<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book store</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel='stylesheet' href='styleBanana/style.css'>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <div class='bestSeller'>
        <span class='title'>Best Sellers</span>
        <div class='booksBestSellers'>
            <?php
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
            $dbFound = mysqli_select_db($conn, DB_NAME);
            if (!$dbFound) {
                $error = 'Problem to connect to the database!!';
            } else {
                $query = "SELECT * FROM `Product` ORDER BY releaseDate DESC LIMIT 3 ;";
                $results = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($results)) {
                    echo '<article class="cardBook">';
                    echo '<div class="divcover"><a href="book.php?id=' . $row['idProduct'] . '"><img class="cover" src=' . $row['cover'] . '></a></div>';
                    echo '<a href="book.php?id=' . $row['idProduct'] . '"><h3 class="">' . $row['title'] . '</h3></a>';
                    echo '</article>';
                }
            }
            mysqli_close($conn);
            ?>
        </div>
        <a class='listBook' href="search.php">List of books</a>
    </div>
</body>

</html>