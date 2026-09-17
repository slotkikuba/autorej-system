<?php include 'kody.php'; ?>
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
            <span class="status-badge">STATUS: GOŚĆ</span>
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

        <input type="text" placeholder="Szukaj po VIN, marce, modelu, roku lub kolorze..." id="searchData">

        <section class="table-section card">
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