<?php
    // Strona dodawania wymaga zalogowanego użytkownika.
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

    // Dane sÄ… czyszczone przed zapisem, a zapytanie korzysta z parametrÃ³w.
    if(isset($_POST['addNew'])) {
        $vin = trim($_POST['vin'] ?? '');
        $marka = trim($_POST['marka'] ?? '');
        $model = trim($_POST['model'] ?? '');
        $rok_produkcji = (int)trim($_POST['rok_produkcji'] ?? '');
        $kolor = trim($_POST['kolor'] ?? '');

        $query = "INSERT INTO pojazdy (vin, marka, model, rok_produkcji, kolor) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if($stmt) {
            mysqli_stmt_bind_param($stmt, "sssis", $vin, $marka, $model, $rok_produkcji, $kolor);

            try {
                if(mysqli_stmt_execute($stmt)) {
                    $_SESSION['flash_message'] = "Pomyślnie dodano rekord.";
                }
            }

            catch(mysqli_sql_exception $exception) {
                if($exception->getCode() === 1062) {
                    $_SESSION['flash_message'] = "Pojazd o takim VIN już widnieje w bazie.";
                } else {
                    $_SESSION['flash_message'] = "Nie udało się dodać pojazdu.";
                    error_log($exception->getMessage());
                }
            }

            mysqli_stmt_close($stmt);
        }

        // Przekierowanie musi nastÄ…piÄ‡ przed wysÅ‚aniem HTML.
        header('Location: dodaj.php');
        exit;
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
            <a href="index.php">Index</a>
            <a href="szukaj.php">Szukaj</a>
            <a href="dodaj.php" class="active">Dodaj</a>
            <a href="usun.php">Usuń</a>
        </div>
    </nav>
    <main class="search-container">

        <div class="divider-header">
            <span class="section-tag">03</span>
            <h2>Dodaj pojazd</h2>
        </div>

        <!-- Formularz zbiera komplet danych wymaganych przez tabelę pojazdy. -->
        <div class="addNewCar">
            <form method="post" class="addNewForm">
                <input type="text" placeholder="VIN" id="vin" name="vin" required>
                <input type="text" placeholder="MARKA" id="marka" name="marka" required>
                <input type="text" placeholder="MODEL" id="model" name="model" required>
                <input type="number" placeholder="ROK_PRODUKCJI" id="rok_produkcji" name="rok_produkcji" required>
                <input type="text" placeholder="KOLOR" id="kolor" name="kolor" required>
                <input type="submit" value="Dodaj" name="addNew">
            </form>
        </div>

        <?php if($flashMessage): ?>
            <div class="pop-up" role="status">
                <?= htmlspecialchars($flashMessage, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

    </main>

    <footer>
        <div class="container">
            <p>Jakub Wiła &copy; 2026 AutoRej.sys</p>
        </div>
    </footer>

    <script src="script/script.js"></script>
</body>
</html>