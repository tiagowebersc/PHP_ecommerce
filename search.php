<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='styleBanana/style.css'>
    <title>Document</title>
</head>

<body>
    <section id='bookshalf'>

        <?php

        include_once('database.php');
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        $db_name = DB_NAME;
        $db_found = mysqli_select_db($connection, $db_name);
        if ($db_found) {
            $query = 'SELECT title , cover FROM Product';
            $resoult = mysqli_query($connection, $query);
            while ($db_record = mysqli_fetch_assoc($resoult)) {
               echo '<article class="cardBook">';
               echo  '<div><img class="cover" src='.$db_record['cover'].'></div>';
               echo '<h3 class="">'.$db_record['title'].'</h3>';
               echo '</article>';
            }
        }
        ?>

    </section>
</body>

</html>