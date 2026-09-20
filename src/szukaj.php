<?php
    // Wyszukiwanie na tej stronie działa po stronie przeglądarki na już pobranej tabeli.
    include 'kody.php';

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
            <h2>Wyszukiwarka pojazdów</h2>
        </div>

        <!-- Pole wyszukiwania filtruje wiersze tabeli przez script.js. -->
        <input type="text" placeholder="Szukaj po VIN, marce, modelu, roku lub kolorze..." id="searchData">

        <section class="table-section card">
            <?php // Dane są pobierane raz, a dalsze filtrowanie odbywa się w JavaScript. ?>
            <?php [$pojazdy, $numberOfRows] = baza($conn); ?>

            <div class="table-header">
                <span class="section-tag">BAZA DANYCH — TABELA: POJAZDY</span>
                <?php
                    echo "<p>" . $numberOfRows . " rekordów</p>";
                ?>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>VIN</th>
                        <th>MARKA</th>
                        <th>MODEL</th>
                        <th>ROK</th>
                        <th>KOLOR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($pojazdy as $row) {
                            echo '<tr>';
                            echo '<td><code>' . htmlspecialchars($row['vin']) . '</code></td>';
                            echo '<td>' . htmlspecialchars($row['marka']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['model']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['rok_produkcji']) . '</td>';
                            echo '<td><span>' . htmlspecialchars($row['kolor']) . '</span></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>

    </main>




        <footer>
        <div class="container">
            <p>Jakub Wiła &copy; 2026 AutoRej.sys</p>
        </div>
    </footer>


    <script src="script/script.js"></script>
</body>
</html>