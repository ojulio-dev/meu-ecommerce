<?php

session_start();

require_once(__DIR__ . '/../config/environment.php');

$page = $_GET['page'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <!-- Title -->
        <link rel="shortcut icon" href="../assets/images/favicon/favicon.png" type="image/x-icon">
        <title>Ecommerce</title>

        <!-- Meta TAGs -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= DIR_CSS ?>/dashboard/style.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <div id="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="../?page=home">Home</a>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="?page=create">Create</a>
                    </div>
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="?page=read">Read</a>
                    </div>
                </div>
            </nav>

            <?php  

            if (isset($_SESSION['customer']) && $_SESSION['customer']['admin'] == 1) {
                if (file_exists( __DIR__ . '/pages/' . $page . '/main.php')) {
                    require_once( __DIR__ . '/pages/' . $page . '/main.php');
                } else {
                    header("Location: index.php?page=read");
                }
    
                if (!isset($page)) {
                    header("Location: index.php?page=read");
                }

            } else {
                header("Location: ../index.php?page=home");
            }
            
            ?>
        </div>
    </body>
</html>