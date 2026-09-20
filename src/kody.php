<?php
    // Wspólna sesja i połączenie z bazą używane przez wszystkie podstrony.
    session_start();

    $db_host = getenv('DB_HOST') ?: 'localhost';
    $db_user = getenv('DB_USER') ?: 'root';
    $db_pass = getenv('DB_PASSWORD') ?: '';
    $db_name = getenv('DB_NAME') ?: 'projekt';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if (!$conn) {
        die("Błąd połączenia z bazą: " . mysqli_connect_error());
    }

    // Pobiera pojazdy oraz liczbę rekordów wyświetlaną nad tabelą.
    function baza($conn) {
        $query = "SELECT * FROM pojazdy";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Błąd w wykonaniu zapytania: " . mysqli_error($conn));
        }

        $numberOfRows = mysqli_num_rows($result);

        return [$result, $numberOfRows];
    }

    // Sprawdza dane logowania i zapisuje podstawowe dane użytkownika w sesji.
    function logIn($conn, $login, $password) {
        $query = "SELECT * FROM uzytkownicy WHERE nazwa = '$login'";
        $result = mysqli_query($conn, $query);

        $user = mysqli_fetch_assoc($result);
        
        if ($user && password_verify($password, $user['haslo'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['rola'];
            $_SESSION['flash_message'] = 'Pomyślnie zalogowano';

            return true;
        }
        else {
            $_SESSION['flash_message'] = "Błędny login lub hasło";
            return false;
        }

    }

    // Haszuje hasło przed zapisaniem nowego użytkownika w bazie.
    function register($conn, $login, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO uzytkownicy (nazwa, haslo) VALUES
        ('$login', '$hashedPassword')";

        $registered = mysqli_query($conn, $query);

        if ($registered) {
            $_SESSION['flash_message'] = 'Pomyślnie zarejestrowano';
        }

        return $registered;
    }

    // Kończy sesję użytkownika i usuwa zapisane w niej dane.
    function logout() {
        session_unset();
        session_destroy();
    }
?>
