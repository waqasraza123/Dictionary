<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link type="text/css" href="css.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="form">
            <?php

            $str = file_get_contents('dictionary.json.txt');
            $json = json_decode($str, true); // decode the JSON into an associative array
            //print_r($json);
            ?>

            <form method="post" action="<?php echo ($_SERVER['PHP_SELF'])?>">
                <div class="form-group">
                    <label for="search-text">Type your word to search</label>
                    <input type="text" name="search-text" class="form-control">
                </div>
                <input type="submit" name="search" value="Search" class="form-control btn btn-primary">
            </form>

            <?php
                if(isset($_POST['search-text'])) {
                    echo '<div class="panel panel-default"><div class="panel-heading"><h1>' .'You Searched For '. strtoupper($_POST['search-text']) . '</h1><br></div></div>';
                }
            ?>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])){
                $searchTerm = $_POST['search-text'];
                /*echo $searchTerm;*/
                $count=0;
                foreach($json as $key => $value){
                    //check if the term exists
                    if(strpos($key, strtoupper($searchTerm))!==false) {
                        echo '<b>'.$key.'</b>' .' '.$value.'<br><br>';
                        $count++;
                    }
                }

            if($count==0){
                    echo '<h1>'.'Nothing Matches Your Search'.'</h1>';
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>