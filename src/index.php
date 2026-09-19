<?php
    include 'kody.php';

    if(isset($_POST['logout'])) {
        logout();
        header('Location: index.php');
        exit;
    }

    if(isset($_POST['loginUsername'], $_POST['loginPassword'])) {
        $login = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];

        logIn($conn, $login, $password);

        header('Location: index.php');
        exit;
        
    }

    if(isset($_POST['registerUsername'], $_POST['registerPassword'])) {
        $login = $_POST['registerUsername'];
        $password = $_POST['registerPassword'];

        if(register($conn, $login, $password)) {
            header('Location: index.php');
            exit;
        }
    }

    $statusClass = "guest";
    $statusText = "GOŚĆ";

    $flashMessage = $_SESSION['flash_message'] ?? null;
    unset($_SESSION['flash_message']);

    if(isset($_SESSION['role'])) {
        $statusClass = $_SESSION['role'];
        $statusText = strtoupper($_SESSION['role']);
    }
?>  

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/icon.svg">
    <title>AutoRej.sys - System Zarządzania Pojazdami</title>
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
            <?php if($flashMessage): ?>
                <div class="pop-up" role="status">
                    <?= htmlspecialchars($flashMessage, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>
            <div class="card right">
                <span class="section-tag">02 / PANEL DOSTĘPU</span>

                <div class="login-form">
                    <form action="index.php" method="post">
                        <label for="loginUsername">LOGIN</label>
                        <input type="text" name="loginUsername" id="loginUsername" placeholder="Wpisz login" required>

                        <label for="loginPassword">HASŁO</label>
                        <input type="password" name="loginPassword" id="loginPassword" placeholder="Wpisz hasło" required>

                        <div class="login-actions">
                            <button type="submit">Zaloguj</button>
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <button type="submit" name="logout" value="1" formnovalidate>Wyloguj</button>
                            <?php endif; ?>
                        </div>

                    </form>
                    <span class="demo-hint">Nie masz konta? <button id="registerBtn" type="button">Zarejestruj się</button></span>
                </div>  

                <div class="register-form">
                    <form action="index.php" method="post">
                        <label for="reigsterUsername">LOGIN</label>
                        <input type="text" name="registerUsername" id="reigsterUsername" placeholder="Wpisz login" required>

                        <label for="registerPassword">HASŁO</label>
                        <input type="password" name="registerPassword" id="registerPassword" placeholder="Wpisz hasło" required>

                        <button type="submit">Załóż konto</button>

                    </form>
                    <span class="demo-hint">Masz już konto? <button id="loginBtn" type="button">Zaloguj się</button></span>
                </div>  

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

    <script src="script/script.js"></script>
</body>
</html>