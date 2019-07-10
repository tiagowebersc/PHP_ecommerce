<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
    include_once('database.php');
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);

    $db_name = DB_NAME;

    $db_found = mysqli_select_db($connection, $db_name);

    if ($db_found) {
      
        $query = 'SELECT * FROM Product ';
        $resoult = mysqli_query($connection, $query);
        while ($db_record = mysqli_fetch_assoc($resoult)) {
            
        }

    } else echo $db_name . ' not found   ! <br>';

    mysqli_close($connection);
    ?>
    <form action="" method='POST'>
        <input type="text" placeholder='book name'>
        <input type="number" placeholder='book price'>
        <input type="date">
        <label for='date'>release date</label>
        <input type="text" placeholder='cover link'>
    </form>
</body>

</html>