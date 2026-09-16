<?php include 'kody.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/icon.svg">
    <title>AutoRej.sys - System Zarządzania Pojazdami</title>
    <link rel="stylesheet" href="style.css">
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

    <div class="container">

        <section class="card hero">
            <span class="accent">v1.0.0 — 2026</span>
            <h1>System Zarządzania <br><span class="accent">Pojazdami</span></h1>
            <p>
                Centralna baza danych pojazdów. Rejestruj, wyszukuj i zarządzaj <br> 
                rekordami w oparciu o numer VIN, markę, model, rok produkcji oraz <br>
                kolor pojazdu.
            </p>
        </section>

        <main class="grid-2">
            <div class="card left">
                <span class="section-tag">01 / INFORMACJE O PROJEKCIE</span>
                
                <div class="author-info">
                    <span class="label">AUTOR</span>
                    <h3>Jakub Wiła</h3>
                </div>

                <p>
                    Aplikacja webowa umożliwiająca zarządzanie bazą pojazdów. System<br>
                    obsługuje dodawanie, wyszukiwanie oraz usuwanie rekordów po <br> 
                    zalogowaniu.
                </p>

                <span class="label">WYKAZ PODSTRON</span>
                <ul class="subpages-list">
                    <li>
                        <code>index.php</code>
                        <span>Strona główna, baza danych, logowanie</span>
                    </li>
                    <li>
                        <code>szukaj.php</code>
                        <span>Wyszukiwarka pojazdów</span>
                    </li>
                    <li>
                        <code>dodaj.php</code>
                        <span>Rejestracja nowych pojazdów</span>
                    </li>
                    <li>
                        <code>usun.php</code>
                        <span>Usuwanie rekordów (admin)</span>
                    </li>
                </ul>
            </div>

            <div class="card right">
                <span class="section-tag">02 / PANEL DOSTĘPU</span>

                <form action="index.php" method="post">
                    <label for="login">LOGIN</label>
                    <input type="text" name="login" id="login" placeholder="Wpisz login" required>

                    <label for="password">HASŁO</label>
                    <input type="password" name="password" id="password" placeholder="Wpisz hasło" required>

                    <button type="submit">Zaloguj</button>
                </form>
                <span class="demo-hint">demo: admin / admin123</span>
            </div>
        </main>

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

    </div>

    <footer>
        <div class="container">
            <p>Jakub Wiła &copy; 2026 AutoRej.sys</p>
        </div>
    </footer>

</body>
</html>