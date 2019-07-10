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
        <div id='shelfnav'>
            <!-- Books container (cover + title)-->
            <section id='bookshelf'>

                <?php

                include_once('database.php');
                $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
                $db_name = DB_NAME;
                $db_found = mysqli_select_db($connection, $db_name);
                if ($db_found) {
                    $page = 0;
                    if (isset($_GET['gotopage'])) {
                        echo $page = $_GET['gotopage'] * 6;
                    }
                    $query = "SELECT title , cover FROM Product limit $page,6";

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
            <div id='pagenav'>
                <form action="" method='GET'>
                    <div>
                        <input type="submit" value='0' name='gotopage' class='goto'>
                        <input type="submit" value='1' name='gotopage' class='goto'>
                        <input type="submit" value='2' name='gotopage' class='goto'>
                       
                    </div>
                </form>
            </div>
        </div>
        <section id='search'>


            <form action="" method="GET" novalidate="novalidate">
                <div class="row">
                    <div id='hsearch'>
                        <h4>
                            Serarch your book!
                        </h4>
                    </div>

                    <input type="text" class="form-control search-slt" placeholder="Author" name='author'>




                    <select class="form-control search-slt" id="exampleFormControlSelect1" name='category'>
                        <option>Select category</option>
                        <option>Adventure</option>
                        <option>Manual</option>
                        <option>Drama</option>
                        <option>Fantasy</option>
                        <option>Horror</option>
                        <option>Crime and Detective</option>
                        <option>Historical Fiction</option>

                    </select>

                    <select class="form-control search-slt" id="exampleFormControlSelect1" name='format'>
                        <option>Select Format</option>
                        <option>Large</option>
                        <option>Poket</option>
                    </select>

                    <input type="submit" class="btn btn-danger wrn-btn" value='search!' name='input'>


            </form>

            </div>
        </section>

    </main>

</body>




<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>