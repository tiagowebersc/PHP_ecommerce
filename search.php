<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- fontawesome kit -->
    <script src="https://kit.fontawesome.com/6fd801e476.js"></script>
    <!-- bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel='stylesheet' href='styleBanana/style.css'>
    <title>Document</title>


</head>

<body>


    <main>

        <!-- Books container (cover + title)-->
        <section id='bookshelf'>

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
                    echo  '<div class="divcover"><img class="cover" src=' . $db_record['cover'] . '></div>';
                    echo '<h3 class="">' . $db_record['title'] . '</h3>';
                    echo '</article>';
                }
            }
            ?>

        </section>
        <section id='search'>


            <form action="#" method="post" novalidate="novalidate">
                <div class="row">
                    <div id='hsearch'>
                        <h4>
                            Serarch your book!
                        </h4>
                    </div>

                    <input type="text" class="form-control search-slt" placeholder="Author">


                   

                    <select class="form-control search-slt" id="exampleFormControlSelect1">
                        <option>Select category</option>
                        <option>Adventure</option>
                        <option>Manuals</option>
                        <option>Drama</option>
                        <option>Fantasy</option>
                    
                    </select>

                    <select class="form-control search-slt" id="exampleFormControlSelect1">
                        <option>Select Vehicle</option>
                        <option>Large</option>
                        <option>Poket</option>
                    </select>


                    <button type="button" class="btn btn-danger wrn-btn">Search</button>


            </form>
            </div>

    </main>
</body>




<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>