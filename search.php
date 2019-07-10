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
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>


</head>

<body>

    <?php
    include_once('header.php');
    ?>
    <main>
        <div id='shelfnav'>
            <!-- Books container (cover + title)-->
            <section id='bookshelf'>

                <?php

                include_once('database.php');
                $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
                $db_name = DB_NAME;
                $db_found = mysqli_select_db($connection, $db_name);
                $page = 0;
                if ($db_found) {

                    if (isset($_GET['gotopage'])) {
                        $page = $_GET['gotopage'] * 6;
                    }
                    $query = "SELECT title , cover FROM Product limit $page,6";

                    if (isset($_GET['input']) && ($_GET['format'] > 0 || $_GET['category'] > 0 || $_GET['author'] != '')) {
                        $query = "SELECT p.title , p.cover FROM Product p INNER JOIN Author a ON p.Author_idAuthor = a.idAuthor";
                        if (isset($_GET['format']) && $_GET['format'] > 0) {
                            $query = $query . " AND p.Format_idFormat =" . $_GET['format'];
                        }

                        if (isset($_GET['category']) && $_GET['category'] > 0) {
                            $query = $query . " AND p.Category_idCategory =" . $_GET['category'];
                        }
                        if (isset($_GET['author']) && $_GET['author'] != '') {
                            $query = $query . " AND UPPER(a.name) like UPPER ('%" . $_GET['author'] . "%')";
                        }
                        $query = $query . " LIMIT $page,6";
                    }

                    $resoult = mysqli_query($connection, $query);

                    $bookNum = 0;
                    while ($db_record = mysqli_fetch_assoc($resoult)) {
                        echo '<article class="cardBook">';
                        echo  '<div class="divcover"><img class="cover" src=' . $db_record['cover'] . '></div>';
                        echo '<h3 class="">' . $db_record['title'] . '</h3>';
                        echo '</article>';
                        $bookNum++;
                    }
                    if ($bookNum == 0) {
                        echo '<h4>No book found! <br> try different combinations! </h3>';
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
                        <option value='0'>Select category</option>
                        <option value='2'>Adventure</option>
                        <option value='1'>Manual</option>
                        <option value='4'>Drama</option>
                        <option value='7'>Fantasy</option>
                        <option value='6'>Horror</option>
                        <option value='3'>Crime and Detective</option>
                        <option value='5'>Historical Fiction</option>

                    </select>

                    <select class="form-control search-slt" id="exampleFormControlSelect1" name='format'>
                        <option value='0'>Select Format</option>
                        <option value='2'>Large</option>
                        <option value='1'>Poket</option>
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