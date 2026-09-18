<?php
    include 'kody.php';
    require_once("auth.php");

    if(isset($_POST['logout'])) {
        logout();
        header('Location: index.php');
        exit;
    }

    if(isset($_POST['loginUsername'], $_POST['loginPassword'])) {
        $login = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];

        if(logIn($conn, $login, $password)) {
            header('Location: index.php');
            exit;
        }
    }

    $statusClass = "guest";
    $statusText = "GOŚĆ";

    if(isset($_SESSION['role'])) {
        $statusClass = $_SESSION['role'];
        $statusText = strtoupper($_SESSION['role']);
    }

    $flashMessage = $_SESSION['flash_message'] ?? null;
    unset($_SESSION['flash_message']);

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/icon.svg">
    <title>Szukaj pojazdu</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">
                <img src="assets/logo.svg" alt="logo">
                <div class="logo-text">
                    <h4>AutoRej<span class="accent dot">.</span>sys</h4>
                    <span>SYSTEM ZARZĄDZANIA POJAZDAMI</span>
                </div>
            </div>
            <?php
                echo '<span class="status-badge '.$statusClass.'">STATUS: '. $statusText.'</span>';
            ?>
        </div>
    </header>
    <nav class="main-nav">
        <div class="container">
            <a href="index.php" class="active">Index</a>
            <a href="szukaj.php">Szukaj</a>
            <a href="dodaj.php">Dodaj</a>
            <a href="usun.php">Usuń</a>
        </div>
    </nav>
    <main class="search-container">

        <div class="divider-header">
            <span class="section-tag">03</span>
            <h2>Dodaj pojazd</h2>
        </div>
        <div class="addNewCar">
            <form method="post" class="addNewForm">
                <input type="text" placeholder="VIN" id="searchData" name="vin">
                <input type="text" placeholder="MARKA" id="searchData" name="marka">
                <input type="text" placeholder="MODEL" id="searchData" name="model">
                <input type="text" placeholder="ROK_PRODUKCJI" id="searchData" name="rok_produkcji">
                <input type="text" placeholder="KOLOR" id="searchData" name="kolor">
                <input type="submit" value="Dodaj" name="addNew">
            </form>
        </div>

        <?php

            if(isset($_POST['newCarInfo'])) {
                $string = trim($_POST['newCarInfo']);

                $elements = preg_split('/\s+/', $string);
                
                $query = "INSERT INTO pojazdy (vin, marka, model, rok_produkcji, kolor) VALUES ('$elements[0]', '$elements[1]', '$elements[2]', $elements[3], '$elements[4]')";
                mysqli_query($conn, $query);
            }

        ?>


    </main>


        <footer>
        <div class="container">
            <p>Jakub Wiła &copy; 2026 AutoRej.sys</p>
        </div>
    </footer>


    <script src="script/script.js"></script>
</body>
</html>